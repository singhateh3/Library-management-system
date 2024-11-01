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
            {{ __('ALL USERS') }}
        </h2>
    </x-slot>
    <div class="background-wrapper py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('message'))
                <div class="alert alert-message bg-green-500 text-white font-semibold text-center py-2 px-4 rounded m-1">
                    {{ session('message') }}</div>
            @endif
            <div class="mb-4 flex justify-end">
                <a href="{{ route('user.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add New User
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color: rgb(8, 8, 8)">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Name</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Email</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Role</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Tools
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-white">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-black ">
                                        <strong>{{ $user->name }}</strong>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black ">
                                        <strong>{{ $user->email }}</strong>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-black ">
                                        <strong>{{ $user->role }}</strong>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-black ">
                                        <div class="d-flex justify-between w-auto">
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                            <a href="{{ route('user.show', $user->id) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">view</a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this post?')"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                    Delete
                                                </button>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>
