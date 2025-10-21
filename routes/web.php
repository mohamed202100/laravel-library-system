<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\GitHubController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/github', [GitHubController::class, 'redirectToGitHub'])->name('github.login');
Route::get('auth/github/callback', [GitHubController::class, 'handleGitHubCallback']);



Route::get('/dashboard', [BookController::class, 'dashIndex'])
    ->middleware(['auth'])
    ->name('dashboard');


Route::middleware(['auth', 'admin', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::view('/', 'admin.dashboard')->name('dashboard');

        Route::resource('books', BookController::class)->except(['show']);

        Route::resource('authors', AuthorController::class)->except(['show']);

        Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::patch('reservations/{reservation}/return', [ReservationController::class, 'markAsReturned'])->name('reservations.return');

        Route::get('users', [UserController::class, 'index'])->name('users.index');
    });



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::post('books/{book}/reserve', [ReservationController::class, 'store'])->name('books.reserve');
    Route::get('my-reservations', [ReservationController::class, 'myReservations'])->name('reservations.my');
    Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    Route::get('/checkout/{reservation}', [PaymentController::class, 'checkout'])
        ->name('payment.checkout');

    Route::get('/payment-success/{reservation}', [PaymentController::class, 'success'])
        ->name('payment.success');

    Route::get('/payment-cancel', [PaymentController::class, 'cancel'])
        ->name('payment.cancel');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
