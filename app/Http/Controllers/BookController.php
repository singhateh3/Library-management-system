<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['users' => ['books', 'borrow']])->get();

        // dd($books);
        return view('books.index', compact('books'));
    }
    public function create()
    {
        return view('admin.create');
    }
    public function store(BookStoreRequest $request)
    {

        $validated = $request->validated();
        $book = new Book($validated);
        $book->status = $book->quantity <= 0 ? 'unavailable' : 'available';
        $book->save();
        return redirect()->route('admin.index')->with('message', 'Book added successfully');
    }
    public function show($id)
    {
        $book = Book::find($id);
        return view('admin.show', compact('book'));
    }
    public function edit($id)
    {
        $book = Book::find($id);

        return view('admin.edit', compact('book'));
    }
    public function update(BookUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $book = Book::find($id);
        $book->update($validated);
        return redirect()->route('admin.index')->with('message', 'Book Updated successfully');
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('admin.index');
    }
}
