<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use GuzzleHttp\Client as HttpClient;

class PdfController extends Controller
{
    protected $openaiClient;

    public function __construct()
    {
        $this->openaiClient = new HttpClient([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
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

        // Get the uploaded file
        $pdfFile = $request->file('pdf');

        // Parse the PDF file to text
        $parser = new Parser();
        $pdf = $parser->parseFile($pdfFile->getPathname());
        $text = $pdf->getText();

        // Generate questions based on the extracted text
        $questions = $this->generateQuestions($text);

        // Display the questions
        return view('pdf_questions', ['questions' => $questions]);
    }

    protected function generateQuestions($text)
    {
        $maxRetries = 3;
        $delay = 1; // Start with a 1-second delay
    
        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $response = $this->openaiClient->post('chat/completions', [
                    'json' => [
                        'model' => 'gpt-3.5-turbo',
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => 'You are a helpful assistant.'
                            ],
                            [
                                'role' => 'user',
                                'content' => "Generate questions based on the following text:\n\n" . $text,
                            ],
                        ],
                        'max_tokens' => 150,
                    ],
                ]);
    
                $body = json_decode($response->getBody(), true);
    
                // Extract and return the questions
                return $body['choices'][0]['message']['content'];
            } catch (\Exception $e) {
                if ($e->getCode() == 429) {
                    // If rate limited, wait and retry
                    sleep($delay);
                    $delay *= 2; // Exponential backoff
                } else {
                    // Handle other errors
                    return 'Error generating questions: ' . $e->getMessage();
                }
            }
        }
    
        return 'Failed to generate questions after multiple attempts.';
    }
    
}
