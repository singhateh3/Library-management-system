<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>





    <div class="py-12">
        @if (auth()->user()->role == 'admin')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
                <div class="p-6 text-gray-900">

                    <div class="row">
                        <div
                            class="col-md-3 border-r-amber-200 p-lg-3 w-64 h-16 bg-black text-white p-3 rounded-md gap-2 m-2">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Total Users</h5>
                                </div>
                                <div class="card-body">
                                    <strong>{{ $users }}</strong>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-md-3 border-r-amber-200 p-lg-3 w-64 h-16 bg-red-500 text-white p-3 rounded-md gap-2 m-2">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Total Books</h5>
                                </div>
                                <div class="card-body">
                                    <strong>{{ $books }}</strong>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-md-3 border-r-amber-200 p-lg-3 w-64 h-16 bg-red-500 text-white p-3 rounded-md gap-2 m-2">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Total Borrowed</h5>
                                </div>
                                <div class="card-body">
                                    <strong>{{ $borrowed }}</strong>
                                </div>
                            </div>
                        </div>


                    </div>
                @else
                    <div>
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                                    style="background-color: rgb(234, 217, 217)">
                                    <div class="p-6 text-gray-900">
                                        <h1><strong>Hello {{ $user->name }}</strong></h1>
                                        <p><strong>Welcome to The Library</strong></p>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

</x-app-layout>
