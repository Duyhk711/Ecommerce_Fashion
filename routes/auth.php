<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/login', [AuthenticationController::class, 'postLogin'])->name('postLogin');
Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/register', [AuthenticationController::class, 'postRegister'])->name('postRegister');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::post('/forgot-password', [AuthenticationController::class, 'sendOtp'])->name('send-otp');
Route::get('/verify-otp', [AuthenticationController::class, 'showVerifyOtpForm'])->name('verify-otp');

// Xác minh OTP từ người dùng
Route::post('/verify-otp', [AuthenticationController::class, 'verifyOtp'])->name('verify-otp');

// Hiển thị form đặt lại mật khẩu
Route::get('/reset-password', [AuthenticationController::class, 'showResetPasswordForm'])->name('reset-password');

// Đặt lại mật khẩu mới
Route::post('/reset-password', [AuthenticationController::class, 'resetPassword'])->name('reset-password');
