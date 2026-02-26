<?php

use App\Http\Controllers\Auth\Dentist\DentistAuthController;
use App\Http\Controllers\DashBoard\DentistDashBoardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Dentist Auth
Route::prefix('dentist')->group(function () {
    Route::post('/register', [DentistAuthController::class, 'Register']);
    Route::post('/login',    [DentistAuthController::class, 'login']);

    // Protected
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [DentistAuthController::class, 'logout']);
        Route::Post('/dashboard', [DentistDashBoardController::class, 'dashboard']);
        Route::post('/dashboard/search', [DentistDashBoardController::class, 'search']);
        Route::post('/dashboard/notifications', [DentistDashBoardController::class, 'notification']);

    });
});
