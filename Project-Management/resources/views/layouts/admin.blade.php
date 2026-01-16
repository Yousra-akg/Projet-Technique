<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('tasksview.app_name') }}</title>
    
</head>
<body class="bg-gray-50 font-sans text-gray-700">
    @yield('content')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>