<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
        <!-- Background Theme -->
        <div class="absolute inset-0 -z-10 bg-gray-50 dark:bg-gray-900">
            <div
                class="absolute top-0 left-1/4 w-96 h-96 bg-purple-300/30 dark:bg-purple-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob">
            </div>
            <div
                class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-300/30 dark:bg-indigo-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-8 left-1/3 w-96 h-96 bg-pink-300/30 dark:bg-pink-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000">
            </div>
        </div>

        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-xl overflow-hidden sm:rounded-2xl border border-white/20 dark:border-gray-700/50">
            {{ $slot }}
        </div>
    </div>
</body>

</html>