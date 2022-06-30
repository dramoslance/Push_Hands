<?php

use Illuminate\Support\Facades\Route;

// routes user
Route::middleware('api')->prefix('auth')->group(base_path('routes/api/auth.php'));

// routes event
Route::middleware('api')->prefix('event')->group(base_path('routes/api/event.php'));