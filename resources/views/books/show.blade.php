<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <p><strong>Title</strong></p>
        <p>{{ $book->title }}</p>
        <p><strong>Author</strong></p>
        <p>{{ $book->author }}</p>
        <p><strong>Quantity</strong></p>
        <p>{{ $book->quantity }}</p>
        <p><strong>Status</strong></p>
        <p>{{ $book->status }}</p>
    </div>
    <div><a href="{{ route('book.index') }}">Back</a></div>
</body>

</html>
