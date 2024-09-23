<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BorrowController extends Controller
{
    public function create($id)
    {
        $book = Book::find($id);

        $borrow = Borrow::where('book_id', $id)->exists();

        if ($borrow) {
            return redirect()->back()->with(['message' => 'Book is currently borrowed and cannot be borrowed again until returned or rejected.'], 400);
        }
        // Check if the book can be borrowed
        if ($book->status === 'available' && $book->quantity > 0) {
            // Create a borrow record
            $borrow = Borrow::create([

                'book_id' => $id,
                'student_id' => Auth::id(),
                'status'  => 'pending',
                'borrow_date' => now(),
                'return_date' => Carbon::now()->addDays(10)->format('Y-m-d'),

            ]);


            return redirect()->back()->with(['message' => 'Book borrowed successfully!']);
        }
    }

    public function book_return($id)
    {
        // find the borrowed book it ID
        $borrow = Borrow::find($id);
        // update the status to returned so the the librarian can see it as returned
        $borrow->update(['status' => 'returned']);
        $borrow->save();
        return redirect()->back();
    }

    public function cancel_request($id)
    {
        // Find the borrow record by its ID
        $borrowRecord = Borrow::find($id);
        $book = Book::find($borrowRecord->book_id); // Assuming $id refers to the borrow record, not the book directly

        // Check if the record exists
        if (!$borrowRecord) {
            return redirect()->back();
        }

        // Increment the book quantity since the borrow was canceled
        $book->increment('quantity');
        $book->save();

        // Delete the borrow record
        $borrowRecord->delete();

        return redirect()->back();
    }
}
