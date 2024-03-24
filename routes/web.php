<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DJController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::get('/', [DJController::class, 'index'])->name('dj.index');


// Authentication 
Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login'); 
Route::post('/login', [AuthController::class, 'login'])->name('auth.login'); 

Route::middleware(['auth'])->group(function() { 
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});