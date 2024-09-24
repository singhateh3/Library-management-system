<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Borrow extends Pivot
{
    protected $guarded = [];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }



    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    // Retrieve all borrowed books that have a status of pending.
    public static function  pendingBorrowedBooks()
    {
        // This uses Eloquent's with() method to eager load the relationships for user and book
        return self::with('user', 'book')->whereStatus('pending')->get(); // it fetches the associated user and book data in the same query, improving performance by reducing the number of queries executed.
    }

    // Retrieve all borrowed books that have a status of approve
    public static function  approvedBorrowedBooks()
    {
        return self::with('user', 'book')->whereStatus('approve')->get(); // it fetches the associated user and book data in the same query, improving performance by reducing the number of queries executed.
    }

    // Retrieve all borrowed books that have a status of reject
    public static function  rejectedBorrowedBooks()
    {
        return self::with('user', 'book')->whereStatus('reject')->get(); //it fetches the associated user and book data in the same query, improving performance by reducing the number of queries executed.
    }

    // Retrieve all borrowed books that have a status of returned
    public static function  returnedBorrowedBooks()
    {
        return self::with('user', 'book')->whereStatus('returned')->get(); //it fetches the associated user and book data in the same query, improving performance by reducing the number of queries executed.
    }


    function scopeISApproved() //  this method is used to check the status
    {

        $status = 'pending';

        if ($this->status === 'approve') {
            $status =  '<span class="bg-green-600">Approved</span>';
        } else if ($this->status === 'reject') {
            $status =   '<span class="bg-red-700">Rejected</span>';
        } else if ($this->status === 'returned') {
            $status =   '<span class="bg-red-700">Returned</span>';
        } else {
            $status =   '<span class="">pending</span>';
        }
        return $status;
    }
}
