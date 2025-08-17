<!DOCTYPE html>
<html>
<head>
    <title>Questions and Answers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Questions and Answers</h1>

    <h2>Reviewers</h2>
    <ul>
        @foreach($reviewers as $reviewer)
            <li>{{ $reviewer }}</li>
        @endforeach
    </ul>

    <h2>Generated Questions and Answers</h2>
    <ul>
        @foreach($qaPairs as $pair)
            <li><strong>Q:</strong> {{ $pair['question'] }}<br><strong>A:</strong> {{ $pair['answer'] }}</li>
        @endforeach
    </ul>
</body>
</html>
