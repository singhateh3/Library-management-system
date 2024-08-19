<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>





    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 20px;
                            background-color: #f9f9f9;
                        }

                        .container {
                            max-width: 600px;
                            margin: auto;
                            padding: 20px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            background-color: white;
                        }

                        h1 {
                            text-align: center;
                            color: #333;
                        }

                        p {
                            margin: 10px 0;
                        }

                        .back-link {
                            display: block;
                            text-align: center;
                            margin-top: 20px;
                            text-decoration: none;
                            color: #007bff;
                        }

                        .back-link:hover {
                            text-decoration: underline;
                        }
                    </style>
                    </head>

                    <body>
                        <div class="container">
                            <h1>Book Details</h1>
                            <p><strong>Title:</strong> {{ $book->title }}</p>
                            <p><strong>Author:</strong> {{ $book->author }}</p>
                            <p><strong>Quantity:</strong> {{ $book->quantity }}</p>
                            <p><strong>Status:</strong> {{ $book->status }}</p>
                            <div><a class="back-link" href="{{ route('admin.index') }}">Back</a></div>
                        </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
