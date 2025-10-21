<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReservationController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])
    ->name('admin.')->group(function () {

        Route::view('/', 'admin.dashboard')->name('dashboard');

        Route::resource('books', BookController::class)->except(['show']);

        Route::resource('authors', AuthorController::class)->except(['show']);

        Route::get('reservations', [ReservationController::class, 'index'])->name('reservations.index');
        Route::patch('reservations/{reservation}/return', [ReservationController::class, 'markAsReturned'])->name('reservations.return');
    });



Route::middleware('auth')->group(function () {

    Route::post('books/{book}/reserve', [ReservationController::class, 'store'])->name('books.reserve');
    Route::get('my-reservations', [ReservationController::class, 'myReservations'])->name('reservations.my');
    Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
