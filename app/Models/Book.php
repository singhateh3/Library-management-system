<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'quantity',
        'status',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'borrow', 'id', 'student_id');
    }

    public function borrow(): BelongsToMany
    {
        return $this->belongsToMany(Borrow::class, 'books', 'book_id', 'id');
    }
}
