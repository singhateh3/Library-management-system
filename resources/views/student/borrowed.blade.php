<x-app-layout>
<style>
    .background-wrapper {
        background-image: url("{{ asset('images/books.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
    }
</style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Borrowed Books') }}
        </h2>
    </x-slot>


    <div class="background-wrapper py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgb(2, 2, 2)">
                <div class="p-6 text-gray-900">

                    <body>
                        <div>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            BOOK ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            STATUS</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            BORROW DATE</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            RETURN DATE</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-white">
                                    @foreach ($borrowed_books as $book)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <strong>{{ $book->book->title }}</strong>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <strong>{{ $book->status }}</strong>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <strong>{{ $book->borrow_date }}</strong>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <strong>{{ $book->return_date }}</strong></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($book->status == 'pending')
                                                    <a href="{{ route('cancel_request', $book->id) }}"
                                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">cancel</a>
                                                @elseif ($book->status == 'approve')
                                                    <a href="{{ route('book_return', $book->id) }}"
                                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Return</a>
                                                @endif
                                            </td>

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
