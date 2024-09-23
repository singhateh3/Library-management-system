<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requested Books') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgb(234, 217, 217)">
                <div class="p-6 text-gray-900">

                    <body>

                        <div>
                            <table>
                                <tr>
                                    <th class="px-6 py-4 whitespace-nowrap">Student</th>
                                    <th class="px-6 py-4 whitespace-nowrap">Book</th>
                                    <th class="px-6 py-4 whitespace-nowrap">Borrow Date</th>

                                    <th class="px-6 py-4 whitespace-nowrap">Status</th>
                                    <th class="px-6 py-4 whitespace-nowrap">Action</th>
                                </tr>
                                @foreach ($borrowed_books as $borrow)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrow->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrow->book->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrow->borrow_date }}</td>



                                        <td class="px-6 py-4 whitespace-nowrap">{!! $borrow->scopeISApproved() !!}</td>

                                        @if ($borrow->status == 'approve')
                                            <td>
                                                <a href="{{ route('return_book', $borrow->id) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Returned</a>
                                            </td>
                                        @elseif ($borrow->status == 'pending')
                                            <td>
                                                <a href="{{ route('approve_book', $borrow->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Approve</a>


                                                <a href="{{ route('reject_book', $borrow->id) }}"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Reject</a>
                                            </td>
                                        @else
                                            <td>
                                                <p class="px-6 py-4 whitespace-nowrap">Complete</p>
                                            </td>
                                        @endif


                                    </tr>
                                @endforeach
                            </table>

                        </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
