<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <body>
                        <form action="{{ route('user.store') }}" method="POST"
                            style="max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
                            @csrf

                            <div style="margin-bottom: 15px;">
                                <label for="name" style="display: block; margin-bottom: 5px;">Name</label>
                                <input type="text" name="name" placeholder="Name" required
                                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                            </div>

                            <div style="margin-bottom: 15px;">
                                <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
                                <input type="email" name="email" placeholder="Email" required
                                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                            </div>

                            <div style="margin-bottom: 15px;">
                                <label for="role" style="display: block; margin-bottom: 5px;">Role</label>
                                <select name="role" id="">
                                    <option value="admin">Admin</option>
                                    <option value="student">Student</option>
                                    <option value="librarian">Librarian</option>
                                </select>
                            </div>

                            <div style="margin-bottom: 15px;">
                                <label for="password" style="display: block; margin-bottom: 5px;">Password</label>
                                <input type="password" name="password" placeholder="Password" required
                                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                            </div>

                            <input type="submit" value="Submit"
                                style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        </form>
                    </body>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
