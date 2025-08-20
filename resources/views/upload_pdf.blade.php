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
                $user = auth()->user();
                $subscription = null;
                $maxGenerations = 3; // Default for free users
        
                // Only check subscription if user is authenticated
                if ($user) {
                    // Retrieve the most recent subscription information
                    $subscription = DB::table('subscriptions')
                        ->where('user_id', $user->id)
                        ->orderBy('id', 'desc') // Get the latest subscription
                        ->first();
                    
                    // Determine the max number of generations allowed based on the subscription type
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
                    }

                    // Check the user's generation details
                    $generateNo = $user->generate_no ?? 0;

                    // Calculate remaining uploads
                    if ($subscription && $subscription->subscription_type == 'Elite Plan') {
                        $remainingUploads = 'Unlimited';
                    } else {
                        $remainingUploads = max(0, $maxGenerations - $generateNo);
                    }
                } else {
                    // User not authenticated, set defaults
                    $generateNo = 0;
                    $remainingUploads = $maxGenerations;
                }
                
              
            @endphp
            
            <form action="{{ route('upload.pdf') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                @csrf
                <label for="pdf-upload">Choose File</label>
                <input type="file" id="pdf-upload" name="pdf" accept="application/pdf" required>
                
                <!-- File Preview Section -->
                <div id="file-preview" style="margin: 15px 0; display: none; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                    <h4>Selected File:</h4>
                    <p><strong>Name:</strong> <span id="file-name"></span></p>
                    <p><strong>Size:</strong> <span id="file-size"></span></p>
                    <p><strong>Type:</strong> <span id="file-type"></span></p>
                    <p><strong>Last Modified:</strong> <span id="file-date"></span></p>
                </div>
                
                <button type="submit" class="btn btn-upload" id="upload-btn">Upload PDF</button>
            </form>
            <p class="note">Note: Only PDF files are allowed for upload.</p>
            <p class="remaining-uploads">Remaining uploads: {{ $remainingUploads }}</p> <!-- Display remaining uploads -->
            
            <!-- Debug Console -->
            <div id="debug-console" style="margin-top: 20px; display: none; background: #f1f1f1; padding: 15px; border-radius: 5px; font-family: monospace; font-size: 12px; color: #333;">
                <h4>Debug Log:</h4>
                <div id="debug-messages"></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    <script>
        // File input change handler for file preview
        document.getElementById('pdf-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('file-preview');
            
            if (file) {
                // Show file details
                document.getElementById('file-name').textContent = file.name;
                document.getElementById('file-size').textContent = formatFileSize(file.size);
                document.getElementById('file-type').textContent = file.type || 'Unknown';
                document.getElementById('file-date').textContent = new Date(file.lastModified).toLocaleString();
                
                preview.style.display = 'block';
                
                // Validate file
                if (file.type !== 'application/pdf') {
                    alert('Please select a PDF file only!');
                    this.value = '';
                    preview.style.display = 'none';
                    return;
                }
                
                if (file.size > 10 * 1024 * 1024) { // 10MB
                    alert('File is too large! Maximum size is 10MB.');
                    this.value = '';
                    preview.style.display = 'none';
                    return;
                }
            } else {
                preview.style.display = 'none';
            }
        });
        
        // Form submission handler
        document.getElementById('upload-form').addEventListener('submit', function(e) {
            const file = document.getElementById('pdf-upload').files[0];
            
            if (!file) {
                alert('Please select a PDF file first!');
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            const uploadBtn = document.getElementById('upload-btn');
            uploadBtn.textContent = 'Uploading...';
            uploadBtn.disabled = true;
        });
        
        // Helper function to format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    </script>
</body>
</html>
