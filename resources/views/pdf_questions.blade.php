<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions and Answers</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2D0A32;
            color: #ffffff;
        }
        .sticky-header {
            background-color: #1e0a2a;
            border-bottom: 2px solid #3e0a4b;
        }
        .container {
            background-color: #1e0a2a;
            border-radius: 8px;
            padding: 20px;
        }
        .list-group-item {
            background-color: #3e0a4b;
            border: none;
            color: #ffffff;
        }
        .accordion-button {
            background-color: #4a0a5a;
            color: #ffffff;
        }
        .accordion-button:not(.collapsed) {
            background-color: #6a0a6a;
            color: #ffffff;
        }
        .accordion-body {
            background-color: #3e0a4b;
            color: #ffffff;
        }
    </style>
</head>
<body>

<header class="sticky-top sticky-header p-3">
    <div class="container">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <a href="/"><h1 class="h4">Home</h1></a>
            <div class="mt-2 mt-sm-0">
                <a href="/upload-pdf-form" class="btn btn-outline-light me-2">Re-upload PDF</a>
                <a href="/download-pdf" class="btn btn-outline-light">Download as PDF</a>
            </div>
        </div>
    </div>
</header>

<div class="container my-5">
    <h2 class="mb-4">Reviewers</h2>
    <div class="list-group mb-4">
        @foreach($reviewers as $reviewer)
            <div class="list-group-item">
                {{ $reviewer }}
            </div>
        @endforeach
    </div>

    <h2 class="mb-4">Generated Questions and Answers</h2>
    <div class="accordion" id="qaAccordion">
        @foreach($qaPairs as $index => $pair)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                        {{ $pair['question'] }}
                    </button>
                </h2>
                <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#qaAccordion">
                    <div class="accordion-body">
                        {{ $pair['answer'] }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
