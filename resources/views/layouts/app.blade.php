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

<body class="font-sans antialiased">
    <div class="min-h-screen relative flex flex-col">
        <!-- Background Theme -->
        <div class="fixed inset-0 -z-10 bg-gray-50 dark:bg-gray-900">
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

        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow relative z-10">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="relative z-0 flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border-t border-gray-200 dark:border-gray-700 py-8 relative z-10 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-600 dark:text-gray-400 font-medium">&copy; {{ date('Y') }} Community Hall Management
                    System. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>

</html>