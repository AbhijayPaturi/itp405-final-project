<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::get('/', [TutorialController::class, 'home'])->name('dj.home');

// Authentication and Registration
Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login'); 
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); 

Route::middleware(['auth'])->group(function() { 
    // Authentication and Registration
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Tutorials
    Route::get('/tutorials/new', [TutorialController::class, 'create'])->name('tutorials.create');
    Route::post('/tutorials/{id}/delete', [TutorialController::class, 'delete'])->name('tutorials.delete');
    Route::get('/tutorials/{id}/edit', [TutorialController::class, 'edit'])->name('tutorials.edit');
    Route::post('/tutorials/{id}', [TutorialController::class, 'update'])->name('tutorials.update');

    // Bookmarks
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{id}', [BookmarkController::class, 'unbookmark'])->name('bookmarks.unbookmark');

    // Reviews 
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::get('/reviews/{id}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::post('/reviews/{id}/delete', [ReviewController::class, 'delete'])->name('reviews.delete');
});

// Tutorials
Route::post('/tutorials/{id}/bookmark', [TutorialController::class, 'bookmark'])->name('tutorials.bookmark');

Route::get('/tutorials', [TutorialController::class, 'index'])->name('tutorials.index');
Route::post('/tutorials', [TutorialController::class, 'store'])->name('tutorials.store');

Route::get('/tutorials/{id}', [TutorialController::class, 'show'])->name('tutorials.show');

