<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ALL USERS') }}
        </h2>
    </x-slot>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"style="background-color: rgb(234, 217, 217)">
                <div class="p-6 text-gray-900">

                    <body>
                        <div class="mb-5">
                            <a href="{{ route('user.create') }}" class="p-4 rounded-lg text-white bg-green-500">Add
                                User</a>
                        </div>
                        <div>
                            <table class="table rounded-lg border-collapse bg-slate-50 full-width w-full">
                                <tr class="bg-black text-white">
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tools
                                    </th>
                                </tr>
                                @foreach ($users as $user)
                                    <tr>
                                        <td
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ $user->name }}</td>
                                        <td
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 lowercasecase tracking-wider">
                                            {{ $user->email }}</td>
                                        <td
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ $user->role }}</td>

                                        <td class="px-6 py-4 whitespace-nowrap ">
                                            <div class="d-flex justify-between w-auto">
                                                <a href="{{ route('user.edit', $user->id) }}"
                                                    style="color:rgb(53, 53, 177) ">Edit</a>
                                                <a href="{{ route('user.show', $user->id) }}"
                                                    style="color:green">view</a>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="delete" style="color: red">Delete</button>
                                                </form>
                                            </div>
                                        </td>

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
