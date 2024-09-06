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

        // Check if the book exists
        if (!$book) {
            return redirect()->back();
        }

        // Check if the book can be borrowed
        if ($book->status === 'available' && $book->quantity > 0) {


            // Create a borrow record
            $borrow = Borrow::create([
                'book_id' => $book->id,
                'student_id' => Auth::user()->id,
                'borrow_date' => now(),
                'return_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
            ]);

            return redirect()->route('book.index');
        }

        return redirect()->back();
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
}
