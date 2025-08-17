<!DOCTYPE html>
<html>
<head>
    <title>Quiz Results</title>
</head>
<body>
    <h1>Generated Quiz</h1>
    @foreach ($quiz as $question)
        <div>
            <p>{{ $question['question'] }}</p>
            @foreach ($question['options'] as $option)
                <input type="radio" name="question_{{$loop->parent->index}}" value="{{ $option }}"> {{ $option }}<br>
            @endforeach
        </div>
    @endforeach
</body>
</html>
