<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('messages.title') }}</title>
    
    <!-- Simple CSS for Live Coding (Bootstrap CDN is easiest to remember/use vs clean CSS) -->
    <!-- User asked for "css simple", let's use a very basic style block or CDN -->
    <!-- Basic Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    @yield('content')

    @vite(['resources/js/app.js'])
</body>
</html>
