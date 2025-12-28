<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $hall->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hall Details -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Hall Details</h3>
                    <p class="mb-2"><strong>Location:</strong> {{ $hall->location }}</p>
                    <p class="mb-2"><strong>Capacity:</strong> {{ $hall->capacity }} people</p>
                    <p class="mb-4"><strong>Description:</strong> {{ $hall->description }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded">
                            <span class="block text-sm text-gray-500 dark:text-gray-400">Price Per Day</span>
                            <span class="text-xl font-bold">${{ $hall->price_per_day }}</span>
                        </div>
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded">
                            <span class="block text-sm text-gray-500 dark:text-gray-400">Price Per Hour</span>
                            <span class="text-xl font-bold">${{ $hall->price_per_hour ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <!-- Booking Form for Hall -->
                    <h4 class="text-xl font-bold mb-2">Book This Hall</h4>
                    <form action="{{ route('bookings.store') }}" method="POST"
                        class="bg-gray-50 dark:bg-gray-900 p-4 rounded">
                        @csrf
                        <input type="hidden" name="bookable_type" value="App\Models\CommunityHall">
                        <input type="hidden" name="bookable_id" value="{{ $hall->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Start Date
                                    & Time</label>
                                <input type="datetime-local" name="start_time"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">End Date &
                                    Time</label>
                                <input type="datetime-local" name="end_time"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class="text-red-500 mb-4">{{ $errors->first() }}</div>
                        @endif
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Book Hall
                        </button>
                    </form>
                </div>
            </div>

            <!-- Rooms List -->
            @if($hall->rooms->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-bold mb-4">Available Rooms</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($hall->rooms as $room)
                                <div class="border border-gray-200 dark:border-gray-700 rounded p-4 relative">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-lg font-bold">{{ $room->name }}</h4>
                                        @if($room->isAvailable())
                                            <span class="bg-emerald-100 text-emerald-800 text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wider">Available</span>
                                        @else
                                            <span class="bg-rose-100 text-rose-800 text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wider">Occupied</span>
                                        @endif
                                    </div>
                                    <p class="mb-2 text-sm">{{ $room->description }}</p>
                                    <p class="mb-2 text-sm">Capacity: {{ $room->capacity }}</p>
                                    <p class="mb-4 font-bold text-indigo-400">${{ $room->price_per_day }}/day</p>

                                    <!-- Booking Form for Room -->
                                    <form action="{{ route('bookings.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="bookable_type" value="App\Models\Room">
                                        <input type="hidden" name="bookable_id" value="{{ $room->id }}">
                                        <div class="grid grid-cols-1 gap-2 mb-2">
                                            <input type="datetime-local" name="start_time"
                                                class="shadow appearance-none border rounded w-full py-1 px-2 text-sm dark:bg-gray-700 dark:text-white"
                                                required>
                                            <input type="datetime-local" name="end_time"
                                                class="shadow appearance-none border rounded w-full py-1 px-2 text-sm dark:bg-gray-700 dark:text-white"
                                                required>
                                        </div>
                                        <button type="submit"
                                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-sm">
                                            Book Room
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>