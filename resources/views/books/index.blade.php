<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <body>

                        <div>
                            <div>

                            </div>
                            <table>

                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                </tr>

                                @foreach ($books as $book)
                                    @if (!$book->users->contains('id', auth()->user()->id))
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->status }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('borrow.create', $book->id) }}"
                                                    style="color: blue">Borrow</a>
                                            </td>
                                        </tr>
                                    @elseif (auth()->user()->borrow->where('book_id', $book->id)->contains('status', 'returned'))
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->status }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('borrow.create', $book->id) }}"
                                                    style="color: blue">Borrow
                                                    ({{ auth()->user()->borrow->where('book_id', $book->id)->where('status', 'returned')->count() }})
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </body>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
