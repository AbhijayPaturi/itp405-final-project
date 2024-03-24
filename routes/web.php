<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DJController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;

Route::get('/', [DJController::class, 'index'])->name('dj.index');


// Authentication 
Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');