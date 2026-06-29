<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PhoneVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


// Register & Login & Logout
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

// Verification
Route::post('send-verification-otp', [PhoneVerificationController::class, 'sendVerificationOTP'])->middleware('auth:sanctum');
Route::post('verify-phone', [PhoneVerificationController::class, 'verifyPhone'])->middleware('auth:sanctum');

// ForgotPassword
Route::post('send-otp', [ForgotPasswordController::class, 'sendOTP']);
Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOTP']);
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->middleware('auth:sanctum');


