<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['users' => ['books', 'borrow']])->get();
        $rating = Book::with('reviews')->get();

        // dd($books);
        return view('books.index', compact('books', 'rating'));
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

    public function search(Request $request)
    {
        $search = $request->search;
        $books = Book::where('title', 'like', "%{$search}%")->orwhere('author', 'like', "%{$search}%")->paginate(10);

        return view('books.search', compact('books', 'search'))
            ->with('message', 'Books matching your search criteria.');
    }
    public function admin_Search(Request $request)
    {
        $search = $request->input('search');
        $books = Book::where('title', 'like', "%{$search}%")->orwhere('author', 'like', "%{$search}%")->orwhere('quantity', 'like', "%{$search}%")->paginate(10);

        return view('admin.search', compact('books', 'search'))
            ->with('message', 'Admin Search: Here are the matching books.');
    }
}
