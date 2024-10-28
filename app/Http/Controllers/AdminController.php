<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        return $this->checkRoleAndRedirect('book.index', function () {
            $books = Book::all();
            return view('admin.index', compact('books'));
        });
    }

    public function pending_request()
    {
        return $this->checkRoleAndRedirect('borrowed_books', function () {
            $borrowed_books = Borrow::pendingBorrowedBooks();
            return view('admin.borrow', compact('borrowed_books'));
        });
        $borrowed_books = Borrow::pendingBorrowedBooks();
        return view('admin.borrow', compact('borrowed_books'));
    }

    public function approved_request()
    {
        return $this->checkRoleAndRedirect('borrowed_books', function () {
            $borrowed_books = Borrow::approvedBorrowedBooks();

            return view('admin.borrow', compact('borrowed_books'));
        });
    }

    public function rejected_request()
    {
        return $this->checkRoleAndRedirect('borrowed_books', function () {
            $borrowed_books = Borrow::rejectedBorrowedBooks();

            return view('admin.borrow', compact('borrowed_books'));
        });
    }

    public function returned_request()
    {
        return $this->checkRoleAndRedirect('borrowed_books', function () {
            $borrowed_books = Borrow::returnedBorrowedBooks();

            return view('admin.borrow', compact('borrowed_books'));
        });
    }

    public function approve($id)
    {
        return $this->updateBorrowStatus($id, 'approve', function ($borrowRecord, $book) {
            // update the book quantity
            $this->updateBookQuantity($book, -1);
        });
    }


    public function return_book($id)
    {
        // Update the borrow record status to 'returned'
        return $this->updateBorrowStatus($id, 'returned', function ($borrowRecord, $book) {
            // Update the book quantity and status if applicable
            $this->updateBookQuantity($book, 1);
        });
    }


    public function reject_book($id)
    {
        // Update the borrow record status to 'reject'
        return $this->updateBorrowStatus($id, 'reject');
    }

    public function borrowed_books()
    {
        // let a user see the books he has borrowed
        if (Auth::id()) {
            $borrowed_books = Borrow::where('student_id', Auth::id())->get();
            return view('student.borrowed', compact('borrowed_books'));
        }
    }

    public function dashboard()
    {
        $user = auth()->user(); // Get the authenticated user

        return view('dashboard', [
            'books' => Book::count(), // Total number of books
            'users' => User::count(), // Total number of users
            'borrowed' => Borrow::count(), // Total number of borrowed books
            'user' => $user, // The authenticated user
            'approved_book' => $this->countUserBorrowedBooks($user->id, 'approve'),
            'pending_book' => $this->countUserBorrowedBooks($user->id, 'pending'),
            'rejected_book' => $this->countUserBorrowedBooks($user->id, 'reject'),
            'approve' => Borrow::where('status', 'approve')->count(), // Total approved books
            'reject' => Borrow::where('status', 'reject')->count(), // Total rejected books
            'return' => Borrow::where('status', 'returned')->count(), // Total returned books
            'pending' => Borrow::where('status', 'pending')->count(), // Total pending books


        ]);
    }

    // Check user role and redirect if they are a student

    private function checkRoleAndRedirect($route, $callback)
    {
        if (auth()->user()->role === 'student') {
            return redirect()->route($route);
        }
        // Execute the callback to return the intended view if the user is not a student

        return $callback();
    }

    private function updateBorrowStatus($id, $status, $callback = null)
    {
        // Find the borrow record by its ID
        $borrowRecord = Borrow::find($id);
        if (!$borrowRecord) {
            return redirect()->back();
        }

        // update the status of the borrow record
        $borrowRecord->status = $status;
        $borrowRecord->save(); // Save the changes

        // Find the associated book
        $book = Book::find($borrowRecord->book_id);
        if (!$book) {
            return redirect()->back();
        }

        // if callback is provided, execute it with the borrow record and book
        if ($callback) {
            $callback($borrowRecord, $book);
        }
        return redirect()->back();
    }

    private function updateBookQuantity($book, $change)
    {
        $book->increment('quantity', $change); // Update the quantity by the change value
        // If the quantity is greater than 0, set the book status to 'available'
        if ($book->quantity > 0) {
            $book->status = 'available';
        }
        $book->save();
    }
    // count borrowed books by a user and status
    private function countUserBorrowedBooks($userId, $status)
    {
        return Borrow::where('student_id', $userId)->where('status', $status)->count(); // Count borrowed books for the user with the specified status
    }
}
