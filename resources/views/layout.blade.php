<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <script src="js/app.js"></script>
        <link href="css/app.css" rel="stylesheet" />
    </head>
    <body>

    @yield('content')

    </body>
</html>
