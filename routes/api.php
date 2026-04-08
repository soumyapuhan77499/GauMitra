<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\OtpAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/send-otp', [OtpAuthController::class, 'sendOtp']);
    Route::post('/verify-otp', [OtpAuthController::class, 'verifyOtp']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [OtpAuthController::class, 'me']);
        Route::post('/logout', [OtpAuthController::class, 'logout']);
    });
});
