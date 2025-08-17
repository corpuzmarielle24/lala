<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
</head>
<body>
    <h1>Upload PDF</h1>
    <form action="{{ route('upload.pdf') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf" accept="application/pdf" required>
        <button type="submit">Upload PDF</button>
    </form>
</body>
</html>
