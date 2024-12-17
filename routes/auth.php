<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/login', [AuthenticationController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/register', [AuthenticationController::class, 'postRegister'])->name('postRegister');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthenticationController::class, 'forgotPassword'])->name('forgot-password');
//email otp
Route::post('/forgot-password', [AuthenticationController::class, 'sendOtp'])->name('send-otp');

Route::get('/verify-otp', [AuthenticationController::class, 'showVerifyOtpForm'])->name('verify-otp');
Route::post('/verify-otp', [AuthenticationController::class, 'verifyOtp'])->name('verify-otp');
Route::get('/reset-password', [AuthenticationController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('reset-password');

Route::get('/login-otp-email', [OtpController::class, 'loginOtpEmail'])->name('login-otp-email');
Route::post('/resend-otp-email', [OtpController::class, 'resendOtp_mail'])->name('resend-otp-email');

Route::get('/login-otp-phone', [OtpController::class, 'loginOtpPhone'])->name('login-otp-phone');

Route::post('/send-otp-email', [OtpController::class, 'sendOtp'])->name('send-otp-email');
Route::post('/verify-otp-email', [OtpController::class, 'verifyOtp'])->name('verify-otp-email');

Route::post('/login-otp-phone', [OtpController::class, 'verifyOtpPhone'])->name('verify-otp-phone');

Route::post('/send-otp-phone', [OtpController::class, 'sendOtpPhone'])->name('send.otp.phone');
Route::post('/resend-otp-phone', [OtpController::class, 'resendOtpPhone'])->name('resend.otp.phone');
Route::post('/verify-otp-phone', [OtpController::class, 'verifyOtpPhone'])->name('verifyOtpPhone');

Route::post('/send-otp', [OtpController::class, 'resendOtp'])->name('resend-otp');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
