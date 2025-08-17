<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use GuzzleHttp\Client as HttpClient;
use PDF;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    protected $cohereClient;

    public function __construct()
    {
        $this->cohereClient = new HttpClient([
            'base_uri' => 'https://api.cohere.ai/',
            'headers' => [
                'Authorization' => 'Bearer ' . config('services.cohere.api_key'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

public function uploadPdf(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'pdf' => 'required|mimes:pdf|max:10000',
    ]);

    // Get the authenticated user
    $user = auth()->user();

    // Retrieve the most recent subscription information
    $subscription = DB::table('subscriptions')
        ->where('user_id', $user->id)
        ->orderBy('date', 'desc') // Get the latest subscription
        ->first();

    // Check if the subscription is valid (not expired)
    $isSubscriptionValid = false;
    $maxGenerations = 3; // Default for users without a plan

    if ($subscription) {
        // Assuming a subscription is valid for 30 days (adjust as needed)
        $isSubscriptionValid = now()->diffInDays($subscription->date) <= 30;

        // Determine the max number of generations allowed based on the subscription type
        switch ($subscription->subscription_type) {
            case 'Basic Plan':
                $maxGenerations = 10;
                break;
            case 'Professional Plan':
                $maxGenerations = 20;
                break;
            case 'Elite Plan':
                $maxGenerations = PHP_INT_MAX; // Unlimited
                break;
        }
    }

    // Check the user's generation details
    $generateNo = $user->generate_no ?? 0;
    $generateDate = $user->generate_date;
    $today = now()->format('Y-m-d');

    // Reset the count if today is a new day
    if ($generateDate === null || $generateDate !== $today) {
        $generateNo = 1; // Start from 1 for a new day
        $user->generate_date = $today; // Update the generate date
    } else {
        // If the user has reached their limit
        if ($generateNo >= $maxGenerations) {
            return redirect()->back()->with('error', 'You have reached the limit for file generations today.');
        }
        $generateNo++; // Increment the generation count
    }



    // Get the uploaded file and parse it
    $pdfFile = $request->file('pdf');

    // Parse the PDF file to text
    $parser = new \Smalot\PdfParser\Parser(); // Ensure parser is correctly referenced
    try {
        $pdf = $parser->parseFile($pdfFile->getPathname());
        $text = $pdf->getText();
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error parsing PDF file: ' . $e->getMessage());
    }

    // Generate questions, answers, and reviewers based on the extracted text
    $result = $this->generateQuestionsAndAnswers($text);

    // Check if reviewers are generated
    if (empty($result['reviewers'])) {
        return redirect()->back()->with('error', 'Internet connection issues, make sure you have internet and try again.');
    }else{
            // Update the user's generate_no and generate_date in the database
    $user->generate_no = $generateNo;
    $user->save();
    }

    // Store the result in session to be accessible across requests
    session(['qaPairs' => $result['qaPairs'], 'reviewers' => $result['reviewers']]);

    // Display the questions, answers, and reviewers
    return view('pdf_questions', [
        'qaPairs' => $result['qaPairs'],
        'reviewers' => $result['reviewers']
    ]);
}

protected function generateQuestionsAndAnswers($text)
{
    // Set maximum execution time to 120 seconds
    set_time_limit(120);

    if (auth()->check()) {
        $subscriptionType = DB::table('subscriptions')
            ->where('user_id', auth()->user()->id) 
            ->orderBy('id', 'desc') 
            ->value('subscription_type'); 
    } else {
        $subscriptionType = null; 
    }

    // Set the max items based on the subscription type
    $maxItems = 5;  // Default value
    if ($subscriptionType === 'Basic Plan') {
        $maxItems = 10;
    } elseif ($subscriptionType === 'Professional Plan') {
        $maxItems = 10;
    } elseif ($subscriptionType === 'Elite Plan') {
        $maxItems = 15;
    }

    try {
        $response = $this->cohereClient->post('v1/generate', [
            'json' => [
                'model' => 'command-xlarge-nightly',
                'prompt' => "Generate exactly $maxItems reviewers in the format 'Reviewer 1: [Reviewer Topic] - [Note about Topic]'. Using the exact same reviewers and their notes, generate a list of questions and answers where each question corresponds to the note and each answer to the reviewer topic. The format should be 'Question 1: [Note about Topic]' and 'Answer 1: [Reviewer Topic]'. Maintain consistency in numbering and alignment with the content in $text.",
                'max_tokens' => 3500,
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        $generatedText = $body['generations'][0]['text'] ?? '';

        $qaPairs = [];
        $reviewers = [];
        $currentQuestion = $currentAnswer = '';
        $isAnswer = false;

        foreach (explode("\n", $generatedText) as $line) {
            $trimmedLine = trim($line);
            
            if (empty($trimmedLine)) {
                continue;
            }

            if (preg_match('/^Reviewer \d+:/', $trimmedLine)) {
                // If it's a reviewer line, add it to reviewers list
                $reviewers[] = $trimmedLine;
            } elseif (preg_match('/^Question \d+:/', $trimmedLine)) {
                // Start a new question-answer pair
                if ($currentQuestion && $currentAnswer) {
                    $qaPairs[] = [
                        'question' => $currentQuestion,
                        'answer' => $currentAnswer,
                    ];
                }
                $currentQuestion = $trimmedLine;
                $currentAnswer = '';
                $isAnswer = true;
            } elseif (preg_match('/^Answer \d+:/', $trimmedLine)) {
                // Start a new answer
                $currentAnswer = $trimmedLine;
            } else {
                // Append additional lines to the answer or reviewer
                if ($isAnswer) {
                    $currentAnswer .= ' ' . $trimmedLine;
                } elseif (count($reviewers) > 0) {
                    $reviewers[count($reviewers) - 1] .= ' ' . $trimmedLine;
                }
            }
        }

        // Add the last question-answer pair
        if ($currentQuestion && $currentAnswer) {
            $qaPairs[] = [
                'question' => $currentQuestion,
                'answer' => $currentAnswer,
            ];
        }

        return [
            'qaPairs' => $qaPairs,
            'reviewers' => $reviewers,
        ];
    } catch (\Exception $e) {
        return [
            'qaPairs' => [],
            'reviewers' => [],
            'error' => 'Error generating questions and answers: ' . $e->getMessage(),
        ];
    }
}


    
    

    public function generatePdf()
    {
        // Retrieve the data from the session
        $qaPairs = session('qaPairs', []);
        $reviewers = session('reviewers', []);
    
        // Load the view with the data
        $pdf = PDF::loadView('pdf_view', [
            'qaPairs' => $qaPairs,
            'reviewers' => $reviewers,
        ]);
    
        // Download the PDF
        return $pdf->download('questions_and_answers.pdf');
    }
    


    
    
    
}
