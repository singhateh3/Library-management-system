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
            {{ __('Searched Books') }}
        </h2>
    </x-slot>

    <div class="background-wrapper py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('message'))
                <div class="alert bg-green-500 text-white font-semibold text-center py-2 px-4 rounded m-1">
                    {{ session('message') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgb(8, 8, 8)">
                <div class="p-6 text-gray-900">

                    @if ($books->isEmpty())
                        <p class="text-center text-lg text-white">No Books Found.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                        TITLE</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                        AUTHOR</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                        QUANTITY</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                        STATUS</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                        ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($books as $book)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><strong>{{ $book->title }}</strong>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><strong>{{ $book->author }}</strong>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><strong>{{ $book->quantity }}</strong>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><strong>{{ $book->status }}</strong>
                                        </td>
                                        @can('isAdmin')
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('book.edit', $book->id) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                                <a href="{{ route('book.show', $book->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">View</a>
                                                <form action="{{ route('book.destroy', $book->id) }}" method="POST"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this post?')"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $books->links() }} <!-- Ensure pagination is available -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
