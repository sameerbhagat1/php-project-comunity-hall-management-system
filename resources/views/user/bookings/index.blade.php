<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Header -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Booking History</h3>
                <form action="{{ route('user.bookings.index') }}" method="GET" class="relative flex-1 max-w-md">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search your bookings..."
                        class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-all">
                    <div class="absolute left-3 top-0 bottom-0 flex items-center text-gray-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </form>
            </div>

            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl relative mb-6 shadow-sm"
                    role="alert">
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <thead
                                class="uppercase tracking-wider border-b-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">
                                        Bookable Item</th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">
                                        Schedule</th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">Total
                                        Cost</th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">Status
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">Payment
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($bookings as $booking)
                                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                                                    <span
                                                                        class="block text-gray-900 dark:text-white font-semibold">{{ $booking->bookable->name ?? 'Unknown Item' }}</span>
                                                                    <span
                                                                        class="text-xs text-gray-500">{{ class_basename($booking->bookable_type) }}</span>
                                                                </td>
                                                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                                                    <div class="flex flex-col">
                                                                        <span>{{ $booking->start_time->format('M d, Y') }}</span>
                                                                        <span
                                                                            class="text-xs text-gray-500">{{ $booking->start_time->format('h:i A') }}
                                                                            - {{ $booking->end_time->format('h:i A') }}</span>
                                                                    </div>
                                                                </td>
                                                                <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                                                                    ${{ number_format($booking->total_price, 2) }}
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    <span
                                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                        {{ $booking->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
                                    ($booking->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200') }}">
                                                                        {{ ucfirst($booking->status) }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    <span
                                                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                        {{ $booking->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                                                        {{ ucfirst($booking->payment_status) }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>