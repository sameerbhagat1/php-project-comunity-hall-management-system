<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.rooms.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Community
                                Hall</label>
                            <select name="community_hall_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-white">
                                @foreach($halls as $hall)
                                    <option value="{{ $hall->id }}">{{ $hall->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Name</label>
                            <input type="text" name="name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-white"
                                required>
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Category</label>
                            <input type="text" name="category" placeholder="e.g. Standard, VIP, Suite"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-white"
                                required>
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Description</label>
                            <textarea name="description"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-white"></textarea>
                        </div>
                        <div class="mb-4">
                            <label
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Capacity</label>
                            <input type="number" name="capacity"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-white"
                                required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Price Per
                                    Day</label>
                                <input type="number" step="0.01" name="price_per_day"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-white"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Price Per
                                    Hour</label>
                                <input type="number" step="0.01" name="price_per_hour"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                                Save Room
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>