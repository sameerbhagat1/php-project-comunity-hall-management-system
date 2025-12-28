<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Halls') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('admin.halls.create') }}"
                        class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                        New Hall</a>
                    <table class="min-w-full leading-normal text-gray-900 dark:text-gray-100">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Category</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Location</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Capacity</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Price/Day</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($halls as $hall)
                                <tr>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm">
                                        {{ $hall->name }}
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm">
                                        <span
                                            class="px-3 py-1 bg-slate-900 text-white dark:bg-slate-200 dark:text-slate-900 rounded-lg text-[10px] font-black uppercase tracking-wider">{{ $hall->category }}</span>
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm">
                                        {{ $hall->location }}
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm">
                                        {{ $hall->capacity }}
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm">
                                        ${{ $hall->price_per_day }}</td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm font-medium">
                                        <a href="{{ route('admin.halls.edit', $hall) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('admin.halls.destroy', $hall) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $halls->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>