<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    protected $authService;
    public function login()
    {
        return view('client.login');
    }
    public function register()
    {
        return view('client.register');
    }
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function postLogin(Request $request)
    {
        $isAuthenticated = $this->authService->postLogin($request);

        if ($isAuthenticated) {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }
        return redirect()->back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác!');
    }


    public function postRegister(Request $request, User $user)
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
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Email không tồn tại trong hệ thống.');
        }
        $otp = $this->authService->sendOtp($request->email);
        return redirect('/verify-otp')->with('success', 'OTP đã được gửi đến email của bạn.');
    }
    public function showVerifyOtpForm()
    {
        return view('client.verify-otp');
    }
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);
        if (!$this->authService->verifyOtp($request->otp)) {
            return back()->with('error', 'Mã OTP không hợp lệ hoặc đã hết hạn.');
        }
        $email = $this->authService->getEmailFromSession();
        Session::put('email', $email);
        return redirect('/reset-password')->with('success', 'Mã OTP hợp lệ.');
    }
    public function showResetPasswordForm()
    {
        return view('client.reset-password');
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $email = Session::get('email');


        if (!$email) {
            return redirect('/forgot-password')->with('error', 'Phiên của bạn đã hết hạn. Vui lòng thử lại.');
        }

        // Cập nhật mật khẩu mới
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->password = bcrypt($request->password);
            $user->save();
        } else {
            return redirect('/forgot-password')->with('error', 'Người dùng không tồn tại.');
        }

        // Xóa session sau khi đổi mật khẩu thành công
        Session::forget('email');

        return redirect('/login')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }
}
