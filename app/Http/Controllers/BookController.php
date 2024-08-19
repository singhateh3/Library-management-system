<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'status' => 'required',
            'quantity' => 'required'
        ]);
        $book = new Book($validated);
        $book->status = $book->quantity <= 0 ? 'unavailable' : 'available';
        $book->save();
        return redirect()->route('admin.index');
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
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'status' => 'required',
            'quantity' => 'required'
        ]);
        $book = Book::find($id);
        $book->update($validated);
        return redirect()->route('book.index');
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('admin.index');
    }
}
