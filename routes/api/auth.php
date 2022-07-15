<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RoleController;
use App\Http\Controllers\Api\Auth\PermissionController;

Route::post('/register', [RegisterController::class, 'store'])->name('auth.register');
Route::post('/login', [LoginController::class, 'store'])->name('auth.login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::delete('/logout', [LogoutController::class, 'delete'])->name('auth.logout');
    Route::get('/role', [RoleController::class, 'index'])->name('auth.get.role');
    Route::get('/permission', [PermissionController::class, 'index'])->name('auth.get.permission');
});

Route::group(['middleware' => ['role:super_admin|admin', 'auth:api']], function () {
    Route::post('/role', [RoleController::class, 'store'])->name('auth.set.role');
    Route::delete('/role', [RoleController::class, 'delete'])->name('auth.delete.role');
    Route::post('/permission', [PermissionController::class, 'store'])->name('auth.set.permission');
    Route::delete('/permission', [PermissionController::class, 'delete'])->name('auth.delete.permission');
});