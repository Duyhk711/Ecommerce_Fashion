<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('client.login');
    }

    public function register()
    {
        return view('client.register');
    }

    public function postLogin(AuthRequest $request)
    {
        $isAuthenticated = $this->authService->postLogin($request);

        if ($isAuthenticated) {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }
        return redirect()->back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác!');
    }

    public function postRegister(AuthRequest $request, User $user)
    {
        $isRegistered = $this->authService->postRegister($request, $user);
        if ($isRegistered) {
            return redirect()->route('login')->with('success', 'Registration successful! Please login.');
        }
        return redirect()->back()->with('error', 'Registration failed. Please try again.');
    }
    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('home');
    }

    public function forgotPassword()
    {
        return view('client.forgot-password');
    }

    public function sendOtp(AuthRequest $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email không tồn tại trong hệ thống.');
        }

        $this->authService->setEmailToSession($email);
        $this->authService->sendOtp($email);

        return redirect('/verify-otp')->with('success', 'Mã OTP đã được gửi đến email của bạn.');
    }

    public function showVerifyOtpForm()
    {
        return view('client.verify-otp');
    }

    public function verifyOtp(AuthRequest $request)
    {
        if (!$this->authService->verifyOtp($request->otp)) {
            return back()->with('error', 'Mã OTP không hợp lệ hoặc đã hết hạn.');
        }

        return redirect('/reset-password')->with('success', 'Mã OTP hợp lệ.');
    }

    public function showResetPasswordForm()
    {
        return view('client.reset-password');
    }

    public function resetPassword(AuthRequest $request)
    {
        $email = $this->authService->getEmailFromSession();

        if (!$email) {
            return redirect('/forgot-password')->with('error', 'Phiên của bạn đã hết hạn. Vui lòng thử lại.');
        }

        if (!$this->authService->updatePassword($email, $request->password)) {
            return redirect('/forgot-password')->with('error', 'Người dùng không tồn tại.');
        }

        Session::forget('email');

        return redirect('/login')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}
