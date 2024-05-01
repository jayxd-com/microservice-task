<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckPermission;

// Registration Endpoint
Route::post('/register', [AuthController::class, 'register']);

// Login Endpoint
Route::post('/login', [AuthController::class, 'login']);

// Verify Auth Endpoint
Route::middleware('auth:api')->group(function () {

    Route::apiResource('user', UserController::class);
    Route::apiResource('product', ProductController::class);

});



