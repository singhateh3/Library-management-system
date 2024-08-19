<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('BOOKS') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <body>

                        <div>

                            <table>

                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                </tr>
                                @foreach ($books as $book)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $book->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $book->status }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap"><a
                                                href="{{ route('book.edit', $book->id) }}"
                                                style="color: blueviolet">Edit</a></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><a
                                                href="{{ route('book.show', $book->id) }}" style="color: green">View</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('book.destroy', $book->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="color: red">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div>
                                <a href="{{ route('book.create') }}" style="color: blue">Add Books</a>
                            </div>
                        </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
