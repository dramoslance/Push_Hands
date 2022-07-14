<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;

Route::middleware('auth:api')->get('/', [EventController::class, 'index'])->name('event.index');
Route::get('/{id}', [EventController::class, 'show'])->name('event.show');
Route::delete('/{id}', [EventController::class, 'destroy'])->name('event.destroy');