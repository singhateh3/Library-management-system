<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    // user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{id}/show', [UserController::class, 'show'])->name('user.show');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    // after logging in
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Book crude operations
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book', [BookController::class, 'store'])->name('book.store');
    Route::get('book/{id}/show', [BookController::class, 'show'])->name('book.show');
    Route::get('book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::patch('/book/{id}/update', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    // Borrow a book
    Route::get('book/{id}/borrow', [BorrowController::class, 'create'])->name('borrow.create');
    // Admin viewing a requests
    Route::get('book/pending', [AdminController::class, 'pending_request'])->name('pending_request');
    Route::get('book/approved', [AdminController::class, 'approved_request'])->name('approved_request');
    Route::get('book/rejected', [AdminController::class, 'rejected_request'])->name('rejected_request');
    Route::get('book/returned', [AdminController::class, 'returned_request'])->name('returned_request');
    // responding to borrows
    Route::get('approve/{id}', [AdminController::class, 'approve'])->name('approve_book');
    Route::get('reject_book/{id}', [AdminController::class, 'reject_book'])->name('reject_book');
    Route::get('return_book/{id}', [AdminController::class, 'return_book'])->name('return_book');

    // let student see the books the have borrowed
    Route::get('/student', [BookController::class, 'index'])->name('book.index');
    Route::get('/student/books', [AdminController::class, 'borrowed_books'])->name('borrowed_books');
    // let student return a book
    Route::get('/book/{id}return', [BorrowController::class, 'book_return'])->name('book_return');

    // total books
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

require __DIR__ . '/auth.php';
