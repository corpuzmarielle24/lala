<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PawMonitoring</title>
</head>
<body>
    @foreach($appointments as $appointment)
        Dear {{ $appointment['owner_name'] }},

        <br><br>

        Good Day!

        <br><br>

        Your Case No. is {{ $appointment['case_no'] }}. Please monitor your email for updates. Thank you for trusting PawMonitoring website.

        <br><br>
    @endforeach
</body>
</html>
