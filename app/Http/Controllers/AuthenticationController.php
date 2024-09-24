<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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

    public function sendOtp(AuthRequest $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Email không tồn tại trong hệ thống.');
        }
        $this->authService->setEmailToSession($email);
        $this->authService->sendOtp($email);
        return redirect('/verify-otp')->with('success', 'OTP đã được gửi đến email của bạn.');
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
    //admin
    public function loginAdmin()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }
    public function postAdminLogin(AuthRequest $request)
{
    $isAuthenticated = $this->authService->postAdminLogin($request);
    if ($isAuthenticated === 'not_admin') {
        return redirect()->back()->withInput()->with('error', 'Bạn không có quyền truy cập!');
    }
    if ($isAuthenticated === true) {
        return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập admin thành công!');
    }
    return redirect()->back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác!');
}

    public function logoutAdmin()
    {
        $this->authService->logout();
        return redirect()->route('admin.loginAdmin')->with('success', 'Đăng xuất thành công!');
    }
    public function showVerifyOtpAdminForm()
    {
        return view('admin.auth.verify-otp');
    }
    public function sendOtpAdmin(AuthRequest $request)
{
    $email = $request->input('email');
    $admin = User::where('email', $email)->where('role', 'admin')->first();
    if (!$admin) {
        return redirect()->back()->with('error', 'Email không tồn tại trong hệ thống.');
    }
    $this->authService->setEmailToSession($email);
    $this->authService->sendOtp($email);
    return redirect('admin/verify-otp')->with('success', 'OTP đã được gửi đến email của bạn.');
}
public function verifyOtpAdmin(AuthRequest $request)
{
    if (!$this->authService->verifyOtp($request->otp)) {
        return back()->with('error', 'Mã OTP không hợp lệ hoặc đã hết hạn.');
    }
    return redirect('/admin/reset-password')->with('success', 'Mã OTP hợp lệ.');
}
public function showResetPasswordAdminForm()
    {
        return view('admin.auth.reset-password');
    }
public function resetPasswordAdmin(AuthRequest $request)
{
    $email = $this->authService->getEmailFromSession();
    if (!$email) {
        return redirect('/admin/forgot-password')->with('error', 'Phiên của bạn đã hết hạn. Vui lòng thử lại.');
    }
    if (!$this->authService->updatePassword($email, $request->password)) {
        return redirect('/admin/forgot-password')->with('error', 'Người dùng không tồn tại.');
    }
    Session::forget('email');
    return redirect('/admin/login')->with('success', 'Mật khẩu đã được thay đổi thành công.');
}

public function updateProfile(AuthRequest $request)
{
    $user = User::find(Auth::user()->id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save();
    return redirect()->back()->with('success', 'Thông tin đã được cập nhật thành công!');
}
public function updatePassword(Request $request)
{
    
    $user = User::find(Auth::user()->id);
    if (!Hash::check($request->input('current_password'), $user->password)) {
        return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
    }
    $user->password = Hash::make($request->input('new_password'));
    $user->save();
    return redirect()->back()->with('success', 'Mật khẩu đã được cập nhật thành công!');
}
}
