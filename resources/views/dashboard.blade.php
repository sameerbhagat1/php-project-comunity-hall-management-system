<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Halls Card -->
                <div
                    class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-indigo-100 text-sm font-medium uppercase tracking-wider">Total Halls</p>
                            <p class="text-4xl font-bold mt-1">{{ $stats['total_halls'] }}</p>
                            <div class="flex gap-2 mt-2">
                                <span
                                    class="bg-white/20 px-2 py-0.5 rounded text-[10px] font-bold">{{ $stats['booked_halls'] }}
                                    Booked</span>
                                <span
                                    class="bg-white/20 px-2 py-0.5 rounded text-[10px] font-bold">{{ $stats['available_halls'] }}
                                    Free</span>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Rooms Card -->
                <div
                    class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-green-100 text-sm font-medium uppercase tracking-wider">Total Rooms</p>
                            <p class="text-4xl font-bold mt-1">{{ $stats['total_rooms'] }}</p>
                            <div class="flex gap-2 mt-2">
                                <span
                                    class="bg-white/20 px-2 py-0.5 rounded text-[10px] font-bold">{{ $stats['booked_rooms'] }}
                                    Booked</span>
                                <span
                                    class="bg-white/20 px-2 py-0.5 rounded text-[10px] font-bold">{{ $stats['available_rooms'] }}
                                    Free</span>
                            </div>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- My Bookings Card -->
                <div
                    class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-blue-100 text-sm font-medium uppercase tracking-wider">My Bookings</p>
                            <p class="text-4xl font-bold mt-1">{{ $stats['my_bookings'] }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Available Now Card (Replaces Revenue) -->
                <div
                    class="bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-yellow-100 text-sm font-medium uppercase tracking-wider">Available Now</p>
                            <p class="text-4xl font-bold mt-1">
                                {{ $stats['available_halls'] + $stats['available_rooms'] }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Quick Actions</h3>
                <div class="flex gap-4">
                    <a href="{{ route('user.halls.index') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition">Browse
                        Halls</a>
                    <a href="{{ route('user.rooms.index') }}"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg transition">Search
                        Rooms</a>
                    <a href="{{ route('user.bookings.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">My
                        Bookings</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>