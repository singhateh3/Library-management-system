<x-app-layout>
<style>
    .background-wrapper {
        background-image: url("{{ asset('images/books.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
    }
</style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>




    <div class="background-wrapper py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <body>
                        <h1>User details</h1>
                        <div>
                            <p><strong>Name</strong></p>
                            <p>{{ $user->name }}</p>
                            <p><strong>Email</strong></p>
                            <p>{{ $user->email }}</p>
                            <p><strong>Role</strong></p>
                            <p>{{ $user->role }}</p>
                            <p><strong>Password</strong></p>
                            <p>{{ $user->password }}</p>
                        </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
