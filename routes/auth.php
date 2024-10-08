<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/login', [AuthenticationController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/register', [AuthenticationController::class, 'postRegister'])->name('postRegister');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('forgot-password');
//email otp
Route::post('/forgot-password', [AuthenticationController::class, 'sendOtp'])->name('send-otp');
//phone otp
Route::get('/verify-otp', [AuthenticationController::class, 'showVerifyOtpForm'])->name('verify-otp');
Route::post('/verify-otp', [AuthenticationController::class, 'verifyOtp'])->name('verify-otp');
Route::get('/reset-password', [AuthenticationController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('reset-password');

Route::get('auth/facebook', [SocialAuthController::class, 'redirectToProvider'])->name('auth.facebook');
Route::get('auth/facebook/callback', [SocialAuthController::class, 'handleProviderCallback']);

