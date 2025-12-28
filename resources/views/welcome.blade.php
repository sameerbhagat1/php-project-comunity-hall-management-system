<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Community Hall Management') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav
            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-md fixed w-full z-10 top-0 border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}"
                            class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-600 hover:opacity-80 transition">
                            CommunityHall
                        </a>
                    </div>
                    <div class="flex items-center space-x-6">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 font-medium transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 font-medium transition">Log
                                    in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition shadow-lg shadow-indigo-500/30">Get
                                        Started</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-gray-900 dark:to-gray-800 -z-10">
            </div>
            <!-- Animated Background Blob -->
            <div
                class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
            </div>
            <div
                class="absolute top-0 left-0 -ml-20 -mt-20 w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-0">
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 dark:text-white mb-6 tracking-tight">
                    Book Your Perfect <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Event
                        Space</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Seamlessly manage bookings for weddings, conferences, and community gatherings. Experience the
                    easiest way to find and reserve the perfect hall.
                </p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-lg px-8 py-4 rounded-full font-bold transition transform hover:scale-105 shadow-xl shadow-indigo-500/30">
                        Book Now
                    </a>
                    <a href="#features"
                        class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-lg px-8 py-4 rounded-full font-bold transition">
                        Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-24 bg-white dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Why Choose Us?</h2>
                    <p class="text-gray-600 dark:text-gray-400">Everything you need to manage your community events
                        efficiently.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Feature 1 -->
                    <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-800 hover:shadow-xl transition duration-300">
                        <div
                            class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mb-6 text-indigo-600 dark:text-indigo-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Easy Scheduling</h3>
                        <p class="text-gray-600 dark:text-gray-400">Real-time availability checking prevents double
                            bookings and ensures smooth operations.</p>
                    </div>
                    <!-- Feature 2 -->
                    <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-800 hover:shadow-xl transition duration-300">
                        <div
                            class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-6 text-purple-600 dark:text-purple-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Transparent Pricing</h3>
                        <p class="text-gray-600 dark:text-gray-400">Automated cost calculations based on booking
                            duration and hall rates.</p>
                    </div>
                    <!-- Feature 3 -->
                    <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-800 hover:shadow-xl transition duration-300">
                        <div
                            class="w-14 h-14 bg-pink-100 dark:bg-pink-900/30 rounded-xl flex items-center justify-center mb-6 text-pink-600 dark:text-pink-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-900 dark:text-white">Instant Approvals</h3>
                        <p class="text-gray-600 dark:text-gray-400">Streamlined workflow for admins to approve or reject
                            bookings instantly.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} Community Hall Management System. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>

</html>