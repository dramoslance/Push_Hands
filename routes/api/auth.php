<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RoleController;
use App\Http\Controllers\Api\Auth\PermissionController;

Route::post('/register', [RegisterController::class, 'store'])->name('auth.register');
Route::post('/login', [LoginController::class, 'store'])->name('auth.login');
Route::middleware('auth:api')->delete('/logout', [LogoutController::class, 'delete'])->name('auth.logout');

Route::middleware('auth:api')->get('/role', [RoleController::class, 'index'])->name('auth.get.role');
Route::middleware('auth:api')->post('/role', [RoleController::class, 'store'])->name('auth.set.role');
Route::middleware('auth:api')->delete('/role', [RoleController::class, 'delete'])->name('auth.delete.role');

Route::middleware('auth:api')->get('/permission', [PermissionController::class, 'index'])->name('auth.get.permission');
Route::middleware('auth:api')->post('/permission', [PermissionController::class, 'store'])->name('auth.set.permission');
Route::middleware('auth:api')->delete('/permission', [PermissionController::class, 'delete'])->name('auth.delete.permission');