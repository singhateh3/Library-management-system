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
            {{ __('Requested Books') }}
        </h2>
    </x-slot>
    <div class="background-wrapper py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgb(14, 14, 14)">
                <div class="p-6 text-white">


                    <table class="min-w-full divide-y divide-gray-200">
                        <THead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    STUDENT</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    BOOK</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    BORROW DATE</th>

                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    STATUS</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    ACTION</th>
                            </tr>
                        </THead>
                        <Tbody class="bg-white divide-y divide-white">
                            @foreach ($borrowed_books as $borrow)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-black ">
                                        <strong>{{ $borrow->user->name }}</strong>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black">
                                        <strong>{{ $borrow->book->title }}</strong>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black">
                                        <strong>{{ $borrow->borrow_date }}</strong>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black">
                                        <strong>{!! $borrow->scopeISApproved() !!}</strong>
                                    </td>

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
                        </TBOdy>

                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
