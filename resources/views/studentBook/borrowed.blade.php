<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowed Books') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgb(234, 217, 217)">
                <div class="p-6 text-gray-900">

                    <body>
                        <div>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Book ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Borrow Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Return Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($borrowed_books as $book)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->book->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->status }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->borrow_date }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->return_date }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap"><a
                                                    href="{{ route('book_return', $book->id) }}"
                                                    style="color: gold">Return</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div>

                            </div>
                        </div>
                </div>

                </body>

            </div>
        </div>
    </div>
    </div>
    >

</x-app-layout>
