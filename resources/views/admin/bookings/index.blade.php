<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Header -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Transactions</h3>
                <form action="{{ route('admin.bookings.index') }}" method="GET" class="relative flex-1 max-w-md">
                    <input type="text" name="search" value="{{ $search ?? '' }}" 
                        placeholder="Search by user or item..." 
                        class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-all">
                    <div class="absolute left-3 top-0 bottom-0 flex items-center text-gray-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <thead class="uppercase tracking-wider border-b-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">User</th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">Bookable Item</th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">Schedule</th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">Total Cost</th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">Status</th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold">Payment</th>
                                    <th scope="col" class="px-6 py-4 text-gray-600 dark:text-gray-400 font-bold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($bookings as $booking)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold text-xs">
                                            {{ substr($booking->user->name, 0, 2) }}
                                        </div>
                                        {{ $booking->user->name }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                        <span class="block text-gray-900 dark:text-white font-semibold">{{ class_basename($booking->bookable_type) }}</span>
                                        <span class="text-xs text-gray-500">ID: #{{ $booking->bookable_id }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                        <div class="flex flex-col">
                                            <span>{{ $booking->start_time->format('M d, Y') }}</span>
                                            <span class="text-xs text-gray-500">{{ $booking->start_time->format('h:i A') }} - {{ $booking->end_time->format('h:i A') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                                        ${{ number_format($booking->total_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $booking->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                               ($booking->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                         <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $booking->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                            {{ ucfirst($booking->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center space-x-2">
                                            @if($booking->status === 'pending')
                                                <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 p-2 rounded-full transition" title="Approve">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-full transition" title="Reject">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </form>
                                            @elseif($booking->status === 'approved' && $booking->payment_status !== 'paid')
                                                <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="paid">
                                                    <button class="bg-green-100 hover:bg-green-200 text-green-700 p-2 rounded-full transition" title="Mark Paid">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Delete booking?');">
                                                @csrf @method('DELETE')
                                                <button class="bg-gray-100 hover:bg-gray-200 text-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-300 p-2 rounded-full transition" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
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