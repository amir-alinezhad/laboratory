<?php

use App\Http\Controllers\Auth\Dentist\DentistAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Dentist Auth
Route::prefix('dentist')->group(function () {
    Route::post('/register', [DentistAuthController::class, 'Register']);
    Route::post('/login',    [DentistAuthController::class, 'login']);

    // Protected
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [DentistAuthController::class, 'logout']);
        Route::get('/dashboard', [DentistAuthController::class, 'dashboard']);
    });
});
