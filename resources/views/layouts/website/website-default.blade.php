
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Travel Insurance |Travel Medical Insurance| AXA Partners US</title>
    @include('includes.website.header')
    @yield('customHead')
</head>

<body>
    @yield('content')
    @include('includes.website.footer')
    @yield('insertjavascript')
</body>

</html>

