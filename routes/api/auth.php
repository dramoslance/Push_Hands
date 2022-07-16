<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Auth\RoleController;
use App\Http\Controllers\Api\Auth\PermissionController;

Route::post('/register', [RegisterController::class, 'store'])->name('auth.register');
Route::post('/login', [LoginController::class, 'store'])->name('auth.login');
Route::delete('/logout', [LogoutController::class, 'delete'])->middleware('auth:api')->name('auth.logout');

Route::put('/password/reset', [ResetPasswordController::class, 'update'])->middleware('auth:api')->name('auth.change.password');
Route::post('/password/forgot', [ForgotPasswordController::class, 'send'])->name('auth.send.forgot.password');
Route::patch('/password/forgot/{token}', [ForgotPasswordController::class, 'update'])->name('auth.change.forgot.password');

Route::get('/verify', [VerifyEmailController::class, 'send'])->middleware('auth:api')->name('auth.send.verify');
Route::get('/verify/{token}', [VerifyEmailController::class, 'verify'])->name('auth.get.verify');

Route::get('/role', [RoleController::class, 'index'])->middleware('auth:api')->name('auth.get.role');
Route::get('/permission', [PermissionController::class, 'index'])->middleware('auth:api')->name('auth.get.permission');

Route::group(['middleware' => ['role:super_admin|admin', 'auth:api']], function () {
    Route::post('/role', [RoleController::class, 'store'])->name('auth.set.role');
    Route::delete('/role', [RoleController::class, 'delete'])->name('auth.delete.role');
    Route::post('/permission', [PermissionController::class, 'store'])->name('auth.set.permission');
    Route::delete('/permission', [PermissionController::class, 'delete'])->name('auth.delete.permission');
});