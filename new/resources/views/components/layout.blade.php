@props(['title' => 'Game Puzzle Dekripsi'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto py-10 px-4">
        {{ $slot }}
    </div>
    @stack('scripts')
</body>
</html>

