<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;

Route::post('/register', [RegisterController::class, 'store'])->name('user.register');
Route::post('/login', [LoginController::class, 'store'])->name('user.login');