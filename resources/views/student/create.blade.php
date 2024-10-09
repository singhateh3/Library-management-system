<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>BORROW A BOOK</h1>
    <form action="{{ route('borrow.create', $bookId) }}" method="POST">
        @csrf
        <div>
            <label for="">student id</label><br>
            <input type="text" name="student_id" id="user_id" value="{{ auth()->user()?->name ?? 'Unknown User' }}"
                readonly><br>
            <label for="">book id</label><br>
            <input type="text" name="book_id" value="{{ $bookId }}" readonly><br>
            <label for="">borrow date</label><br>
            <input type="date" name="borrow_date" value="{{ now()->format('Y-m-d') }}" readonly><br>
            <label for="">return date</label><br>
            <input type="date" name="return_date"><br><br>
            <button type="submit">SUBMIT</button>
        </div>

    </form>
</body>

</html>
