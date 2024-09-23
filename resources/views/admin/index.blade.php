<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('BOOKS') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
                <a href="{{ route('book.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add New Book
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgb(234, 217, 217)">
                <div class="p-6 text-gray-900">



                    <table>

                        <tr>
                            <th class="px-6 py-4 whitespace-nowrap">Title</th>
                            <th class="px-6 py-4 whitespace-nowrap">Author</th>
                            <th class="px-6 py-4 whitespace-nowrap">Quantity</th>
                            <th class="px-6 py-4 whitespace-nowrap">Status</th>
                            <th class="px-6 py-4 whitespace-nowrap">action</th>
                        </tr>
                        @foreach ($books as $book)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap "><strong>{{ $book->title }}</strong></td>
                                <td class="px-6 py-4 whitespace-nowrap"><strong>{{ $book->author }}</strong></td>
                                <td class="px-6 py-4 whitespace-nowrap"><strong>{{ $book->quantity }}</strong></td>
                                <td class="px-6 py-4 whitespace-nowrap"><strong>{{ $book->status }}</strong></td>
                                <td class="px-6 py-4 whitespace-nowrap"><a href="{{ route('book.edit', $book->id) }}"
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
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
