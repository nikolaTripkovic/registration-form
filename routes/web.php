<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return redirect('/login');
});

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register-form');
Route::post('register', [AuthController::class, 'registerUser'])->name('register')->middleware('throttle:10,1');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login-form');
Route::post('login', [AuthController::class, 'loginUser'])->name('login');

Route::post('logout', [AuthController::class, 'logoutUser'])->name('logout')->middleware('auth');

Route::get('profile', [UserController::class, 'show'])->name('profile')->middleware('auth');
