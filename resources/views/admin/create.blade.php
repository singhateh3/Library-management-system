<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a new book') }}
        </h2>
    </x-slot>





    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <body>

                        <div>
                            <form action="{{ route('book.store') }}" method="POST"
                                style="max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
                                @csrf

                                <div style="margin-bottom: 15px;">
                                    <label for="title" style="display: block; margin-bottom: 5px;">Title</label>
                                    <input type="text" name="title" placeholder="Title" required
                                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                </div>

                                <div style="margin-bottom: 15px;">
                                    <label for="author" style="display: block; margin-bottom: 5px;">Author</label>
                                    <input type="text" name="author" placeholder="Author" required
                                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                </div>

                                <div style="margin-bottom: 15px;">
                                    <label for="quantity" style="display: block; margin-bottom: 5px;">Quantity</label>
                                    <input type="number" name="quantity" placeholder="Quantity" required
                                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                </div>

                                <div style="margin-bottom: 15px;">
                                    <label for="status" style="display: block; margin-bottom: 5px;">Status</label>
                                    <select name="status" required
                                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                        <option value="available">Available</option>
                                        <option value="unavailable">Unavailable</option>
                                    </select>
                                </div>

                                <button type="submit"
                                    style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Submit</button>
                            </form>

                        </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
