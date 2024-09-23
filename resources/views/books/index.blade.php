<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('message'))
                <div class="alert alert-message bg-green-500 text-white font-semibold text-center py-2 px-4 rounded m-1">
                    {{ session('message') }}</div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgb(234, 217, 217)">
                <div class="p-6 text-gray-900">


                    <table>

                        <tr>
                            <th class="px-6 py-4 whitespace-nowrap">Title</th>
                            <th class="px-6 py-4 whitespace-nowrap">Author</th>
                            <th class="px-6 py-4 whitespace-nowrap">Status</th>
                            <th class="px-6 py-4 whitespace-nowrap">Action</th>
                        </tr>

                        @foreach ($books as $book)
                            @if (!$book->users->contains('id', auth()->user()->id))
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('borrow.create', $book->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Borrow</a>
                                    </td>
                                </tr>
                            @elseif (auth()->user()->borrow->where('book_id', $book->id)->contains('status', 'returned'))
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $book->status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('borrow.create', $book->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Borrow
                                            ({{ auth()->user()->borrow->where('book_id', $book->id)->where('status', 'returned')->count() }})
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
