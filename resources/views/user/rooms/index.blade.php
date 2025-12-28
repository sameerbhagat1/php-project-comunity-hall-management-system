<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Find a Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full leading-normal text-sm">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Category</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Hall</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Capacity</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Price/Day</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                                        {{ $room->name }}
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                                        <span
                                            class="px-3 py-1 bg-slate-900 text-white dark:bg-slate-200 dark:text-slate-900 rounded-lg text-[10px] font-black uppercase tracking-wider">{{ $room->category }}</span>
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                                        {{ $room->communityHall->name }}
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                                        {{ $room->capacity }}
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                                        ${{ $room->price_per_day }}</td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                                        <a href="{{ route('user.halls.show', $room->communityHall) }}"
                                            class="text-indigo-600 hover:text-indigo-900 font-medium">View Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>