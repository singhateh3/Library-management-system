<x-app-layout>
<style>
        .background-wrapper {
            background-image: url('{{ asset('images/books.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Books') }}
        </h2>
    </x-slot>

    @php
        $authUser = auth()->user()->loadCount('borrow');
    @endphp


    <div class="background-wrapper py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('message'))
                <div class="alert alert-message bg-green-500 text-white font-semibold text-center py-2 px-4 rounded m-1">
                    {{ session('message') }}</div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgb(8, 8, 8)">
                <div class="p-6 text-white">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Title
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-white">
                            @foreach ($books as $book)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-black ">
                                        <strong>{{ $book->title }}</strong>
                                    </td>
                                    <td class="text-black px-6 py-4 whitespace-nowrap">
                                        <strong>{{ $book->author }}</strong></td>
                                    <td class="text-black px-6 py-4 whitespace-nowrap">
                                        <strong>{{ $book->status }}</strong></td>
                                    <td class="text-black px-6 py-4 whitespace-nowrap">

                                        @if (auth()->user()->borrow->where('book_id', $book->id)->where('status', 'approve')->count() > 0)
                                            <a href="javascript:void()"
                                                class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Borrowed</a>
                                            ({{ auth()->user()->borrow->where('book_id', $book->id)->count() }})
                                        @else
                                            @if (auth()->user()->borrow->where('book_id', $book->id)->where('status', 'pending')->count() > 0)
                                                <a href="{{ route('borrow.create', $book->id) }}"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                    Requested
                                                </a>
                                            @else
                                                <a href="{{ route('borrow.create', $book->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                    Borrow
                                                </a>
                                            @endif
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
