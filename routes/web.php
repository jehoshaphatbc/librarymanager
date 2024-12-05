<?php

use App\Livewire\Pages\Dashboard\Author\Index as AuthorIndex;
use App\Livewire\Pages\Dashboard\Book\Index as BookIndex;
use App\Livewire\Pages\Dashboard\Category\Index as CategoryIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', CategoryIndex::class)->name('index');
    });

    Route::prefix('author')->name('author.')->group(function () {
        Route::get('/', AuthorIndex::class)->name('index');
    });

    Route::prefix('book')->name('book.')->group(function () {
        Route::get('/', BookIndex::class)->name('index');
    });

});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
