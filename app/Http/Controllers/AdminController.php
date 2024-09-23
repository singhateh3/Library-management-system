<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function entrance()
    {
        if (Auth::check()) {
            $role = Auth()->user()->role;

            if ($role == 'admin') {
                return view('admin.index');
            } else if ($role == 'librarian') {
                return view('admin.borrow');
            } else if ($role == 'student') {
                return view('books.index');
            } else {
                return redirect()->back();
            }
        }
        return abort(401);
    }
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('book.index');
        }
        $books = Book::all();
        return view('admin.index', compact('books'));
    }

    public function pending_request()
    {
        if (auth()->user()->role === 'student') {
            return redirect()->route('borrowed_books');
        }


        $borrowed_books = Borrow::pendingBorrowedBooks();

        return view('admin.borrow', compact('borrowed_books'));
    }

    public function approved_request()
    {
        if (auth()->user()->role === 'student') {
            return redirect()->route('borrowed_books');
        }


        $borrowed_books = Borrow::approvedBorrowedBooks();

        return view('admin.borrow', compact('borrowed_books'));
    }

    public function rejected_request()
    {
        if (auth()->user()->role === 'student') {
            return redirect()->route('borrowed_books');
        }


        $borrowed_books = Borrow::rejectedBorrowedBooks();

        return view('admin.borrow', compact('borrowed_books'));
    }

    public function returned_request()
    {
        if (auth()->user()->role === 'student') {
            return redirect()->route('borrowed_books');
        }


        $borrowed_books = Borrow::returnedBorrowedBooks();

        return view('admin.borrow', compact('borrowed_books'));
    }

    public function approve($id)
    {
        // Find the borrow record by its ID
        $borrowRecord = Borrow::find($id);
        if (!$borrowRecord) {
            return redirect()->back();
        }

        // Change the status to approve
        $borrowRecord->status = 'approve';
        $borrowRecord->save();

        // Find the associated book
        $book = Book::find($borrowRecord->book_id);
        if (!$book) {
            return redirect()->back();
        }

        // Get the student ID from the authenticated user
        $student_id = Auth::user()->id;

        // Check if this student has already approve this book
        $alreadyReturned = Borrow::where('book_id', $book->id)->where('student_id', $student_id)->where('status', 'approve')->count();

        if (!$alreadyReturned) {
            $book->decrement('quantity');

            if ($book->quantity !== 0) {
                $book->status = 'available';
            }
            $book->save();
        }

        return redirect()->back();
    }


    public function return_book($id)
    {
        // Find the borrow record by its ID
        $borrowRecord = Borrow::find($id);
        if (!$borrowRecord) {
            return redirect()->back();
        }

        // Change the status to returned
        $borrowRecord->status = 'returned';
        $borrowRecord->save();

        // Find the associated book
        $book = Book::find($borrowRecord->book_id);
        if (!$book) {
            return redirect()->back();
        }

        // Get the student ID from the authenticated user
        $student_id = Auth::user()->id;

        // Check if this student has already returned this book
        $alreadyReturned = Borrow::where('book_id', $book->id)->where('student_id', $student_id)->where('status', 'returned')->count();

        if (!$alreadyReturned) {
            $book->increment('quantity');

            if ($book->quantity !== 0) {
                $book->status = 'available';
            }
            $book->save();
        }

        return redirect()->back();
    }


    public function reject_book($id)
    {
        // Find the borrow record by its ID
        $borrowRecord = Borrow::find($id);
        // check if the record exists
        if (!$borrowRecord) {
            return redirect()->back();
        }
        // change the status of the record to reject
        $borrowRecord->status = 'reject';
        $borrowRecord->save();
        return redirect()->back();
    }

    public function borrowed_books()
    {
        // let a user see the books he has borrowed
        if (Auth::id()) {
            $borrowed_books = Borrow::where('student_id', Auth::id())->get();
            return view('studentBook.borrowed', compact('borrowed_books'));
        }
    }

    public function dashboard()
    {
        $user = auth()->user();
        $books = Book::count();
        $users = User::count();
        $borrowed = Borrow::count();

        return view('dashboard', compact('books', 'users', 'borrowed', 'user'));
    }
}
