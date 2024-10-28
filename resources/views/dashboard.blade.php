<x-app-layout>
    <style>
        .background-wrapper {
            background-image: url('{{ asset('images/books.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            /* Ensures it covers the viewport height */
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="background-wrapper py-12">
        {{-- Admin Section --}}
        @can('isAdmin')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    {{-- Admin cards --}}
                    <x-dashboard-card title="Total Users" :count="$users" bgColor="bg-black" />
                    <x-dashboard-card title="Total Books" :count="$books" bgColor="bg-red-500" />
                    <x-dashboard-card title="Total Borrowed" :count="$borrowed" bgColor="bg-blue-500" />
                </div>
            </div>
        @endcan

        {{-- Student Section --}}
        @can('isStudent')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    {{-- Student cards --}}
                    <x-dashboard-card title="Approved Books" :count="$approved_book" bgColor="bg-green-500" />
                    <x-dashboard-card title="Rejected Books" :count="$rejected_book" bgColor="bg-red-500" />
                    <x-dashboard-card title="Pending Books" :count="$pending_book" bgColor="bg-yellow-500" />
                </div>
            </div>
        @endcan

        {{-- Librarian Section --}}
        @can('isLibrarian')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"> {{-- Responsive grid layout --}}
                    {{-- Librarian cards --}}
                    <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold">Approved Books</h2>
                        <p class="text-3xl font-semibold">{{ $approve }}</p>
                    </div>
                    <div class="bg-red-500 text-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold">Rejected Books</h2>
                        <p class="text-3xl font-semibold">{{ $reject }}</p>
                    </div>
                    <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold">Pending Books</h2>
                        <p class="text-3xl font-semibold">{{ $pending }}</p>
                    </div>
                    <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-bold">Returned Books</h2>
                        <p class="text-3xl font-semibold">{{ $return }}</p>
                    </div>
                </div>
            </div>
        @endcan
    </div>

</x-app-layout>
