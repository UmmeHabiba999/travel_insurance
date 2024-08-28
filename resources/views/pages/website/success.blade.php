

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Quote</title>
</head>
<body>
    @if(isset($data))
        <h1>Travel Quote</h1>
        <pre>{{ print_r($data, true) }}</pre>
    @else
        <h1>Error</h1>
        <p>{{ $error }}</p>
    @endif
</body>
</html>
