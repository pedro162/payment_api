<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ resource_path('resources/css/app.css')}}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Vite</title>
    @vite('resources/js/app.js')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>

</body>

</html>