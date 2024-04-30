<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Middleware\CheckPermission;

// Registration Endpoint
Route::post('/register', [AuthController::class, 'register']);

// Login Endpoint
Route::post('/login', [AuthController::class, 'login']);

// Verify Auth Endpoint
Route::middleware('auth:api')->group(function () {
    Route::middleware([CheckPermission::class.':create_user,read_user,read_text'])->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });
});



