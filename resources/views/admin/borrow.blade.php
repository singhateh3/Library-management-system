<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requested Books') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <body>
                        <h1>Received request</h1>
                        <div>
                            <table>
                                <tr>
                                    <th class="px-6 py-4 whitespace-nowrap">Student</th>
                                    <th class="px-6 py-4 whitespace-nowrap">Book</th>
                                    <th class="px-6 py-4 whitespace-nowrap">Borrow Date</th>

                                    <th class="px-6 py-4 whitespace-nowrap">Action</th>
                                    <th></th>
                                </tr>
                                @foreach ($borrowed_books as $borrow)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrow->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrow->book->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $borrow->borrow_date }}</td>

                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">{!! $borrow->scopeISApproved() !!}</td>

                                        @if ($borrow->status == 'approve')
                                            <td>
                                                <a href="{{ route('return_book', $borrow->id) }}"
                                                    class="px-6 py-4 whitespace-nowrap"
                                                    style="color: goldenrod">Returned</a>
                                            </td>
                                        @elseif ($borrow->status == 'pending')
                                            <td>
                                                <a href="{{ route('approve_book', $borrow->id) }}"
                                                    class="px-6 py-4 whitespace-nowrap" style="color: blue">Approve</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('reject_book', $borrow->id) }}"
                                                    class="px-6 py-4 whitespace-nowrap" style="color: red">Reject</a>
                                            </td>
                                        @else
                                            <td>
                                                <p style="color: violet">DONE</p>
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
