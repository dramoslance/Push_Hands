<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Organizer\ShowController;
use App\Http\Controllers\Api\Organizer\StoreController;
use App\Http\Controllers\Api\Organizer\UpdateController;
use App\Http\Controllers\Api\Organizer\DestroyController;
use App\Http\Controllers\Api\Organizer\TranslationController;
use App\Http\Controllers\Api\Organizer\MemberController;

Route::group(['middleware' => ['role:admin', 'auth:api']], function () {
    Route::get('/', [ShowController::class, 'index'])->name('organizer.index');
    Route::get('/{id}', [ShowController::class, 'show'])->name('organizer.show');

    Route::post('/', [StoreController::class, 'store'])->name('organizer.store');
    Route::put('/', [UpdateController::class, 'update'])->name('organizer.update');
    Route::delete('/{id}', [DestroyController::class, 'destroy'])->name('organizer.destroy');

    Route::post('/translation', [TranslationController::class, 'store'])->name('organizer.translation.store');
    Route::post('/member', [MemberController::class, 'store'])->name('organizer.member.store');
});