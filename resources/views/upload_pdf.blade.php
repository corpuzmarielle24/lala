<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDFs</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2D0A32;
            font-family: 'Arial', sans-serif;
            color: #fff;
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: #2D0A32;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            font-size: 24px;
            color: #2D0A32;
            margin: 0;
        }
        .description {
            margin-bottom: 30px;
            font-size: 14px;
            line-height: 1.6;
        }
        .upload-section {
            text-align: center;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #f4f4f9;
        }
        .upload-section label {
            display: block;
            background-color: #2D0A32;
            color: #fff;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            width: fit-content;
            margin: auto;
        }
        .upload-section input[type="file"] {
            display: none;
        }
        .btn-upload {
            background-color: #2D0A32;
            color: #fff;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        .btn-upload:hover {
            background-color: #451959;
        }
        .note {
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }
        .remaining-uploads {
            margin-top: 15px;
            font-size: 16px;
            color: #2D0A32;
            font-weight: bold;
        }
        .logo {
            display: block;
            margin: 0 auto 20px auto;
            height: 100px;
        }
         .error-message {
            color: #ff0000; /* Red color for error messages */
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
      <div style="background-color: #2D0A32;border-radius:10px;">
        <a href="#"><img src="{{ asset('ban.png') }}" alt="Logo" class="logo"></a>
      </div>
        <div class="header">
            <h1>Upload Your PDF</h1>
        </div>
        <div class="description">
            <p>Transform your study material effortlessly! Upload your PDF file and our AI-powered tool will help you create customized review questions and example exams from the content. Whether it's a textbook, lecture notes, or study guide, our tool makes it easy to generate flashcards, quizzes, and more to help you study effectively.</p>
        </div>
       
        <div class="upload-section">
               @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif
            <p>Choose a PDF file to upload for analysis or review.</p>
            
            @php
                // Get the authenticated user
                $user= auth()->user();
        
                // Retrieve the most recent subscription information
                $subscription = DB::table('subscriptions')
                    ->where('user_id', $user->id)
                    ->orderBy('id', 'desc') // Get the latest subscription
                    ->first();
                    

                // Determine the max number of generations allowed based on the subscription type
                $maxGenerations = 3; // Default for users without a plan
                if ($subscription) {
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
                }else{
                  $maxGenerations = 3;
                  }

                // Check the user's generation details
                $generateNo = $user->generate_no ?? 0;

                // Calculate remaining uploads
                  if ($subscription) {
                    if($subscription->subscription_type == 'Elite Plan'){
                      $remainingUploads = 'Unlimited';
                    }else{
                      $remainingUploads = max(0, $maxGenerations - $generateNo);
                    }
                }else{
                 $remainingUploads = max(0, $maxGenerations - $generateNo);
                 }
                
              
            @endphp
            
            <form action="{{ route('upload.pdf') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="pdf-upload">Choose File</label>
                <input type="file" id="pdf-upload" name="pdf" accept="application/pdf" required>
                <button type="submit" class="btn btn-upload">Upload PDF</button>
            </form>
            <p class="note">Note: Only PDF files are allowed for upload.</p>
            <p class="remaining-uploads">Remaining uploads: {{ $remainingUploads }}</p> <!-- Display remaining uploads -->
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
