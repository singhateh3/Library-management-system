<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function storeReview(Request $request, $bookId)
    {
        $request->validate([
            'rating'=>'required|integer|min:1|max:5',
            'review'=> 'nullable|string|max:1000',
        ]);

        Review::create([
            'student_id' => Auth::id(),
            'book_id' => $bookId,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('message', 'Review submitted successfully!');
    }

    public function createReview($bookId)
    {
    $book = Book::find($bookId); 
    return view('student.review', compact('book')); 
    }

}
