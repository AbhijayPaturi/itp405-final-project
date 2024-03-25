<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::get('/', [TutorialController::class, 'home'])->name('dj.home');

// Reviews 
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');


// Authentication 
Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login'); 
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); 

Route::middleware(['auth'])->group(function() { 
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/tutorials/new', [TutorialController::class, 'create'])->name('tutorials.create');

    // Bookmarks
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{id}', [BookmarkController::class, 'unbookmark'])->name('bookmarks.unbookmark');
});

// Tutorials

Route::post('/tutorials/bookmark/{id}', [TutorialController::class, 'bookmark'])->name('tutorials.bookmark');

Route::get('/tutorials', [TutorialController::class, 'index'])->name('tutorials.index');
Route::post('/tutorials/{userId}', [TutorialController::class, 'store'])->name('tutorials.store');

Route::get('/tutorials/{id}', [TutorialController::class, 'show'])->name('tutorials.show');
Route::post('/tutorials/delete/{id}', [TutorialController::class, 'delete'])->name('tutorials.delete');

