<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrganizerController;

Route::middleware('auth:api')->get('/', [OrganizerController::class, 'index'])->name('organizer.index');
Route::post('/',[OrganizerController::class, 'store'])->name('organizer.store');
Route::put('/',[OrganizerController::class, 'update'])->name('organizer.update');
Route::get('/{language_id}/{id}', [OrganizerController::class, 'show'])->name('organizer.show');
Route::delete('/{id}', [OrganizerController::class, 'destroy'])->name('organizer.destroy');