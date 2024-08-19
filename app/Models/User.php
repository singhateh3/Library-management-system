<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    const ADMIN = 'admin';
    const STUDENT = 'student';
    const LIBERIAN = 'librarian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'borrow', 'id', 'student_id');
    }

    public function borrow(): HasMany
    {
        return $this->hasMany(Borrow::class, 'student_id', 'id');
    }

    // PRACTISE
    // 1. Create a method in your User model to check if a user has borrowed a specific book and if that book has been returned
    // Create a method named hasReturnedBook($bookId) in the User model.

    public function hasReturnedBook($bookId)
    {
        return $this->borrow->where('book_id', $bookId)->contains('status', 'returned');
    }
    // count the number of time a book has beeen borroweed and returned
    public function countReturnedBooks($bookId)
    {
        return $this->borrow()->where('book_id', $bookId)->contains('status', 'returned')->count();
    }
    public function returnedBooks()
    {
        return $this->borrow()->where('status', 'returned')->get();
    }
}
