<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\AuthRequest;
use App\Notifications\NewUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\FirebaseAuthService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
            return response()->json([
                'success' => true,
                // 'message' => 'Đăng nhập thành công!',
                'redirect' => route('home')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email hoặc mật khẩu không chính xác!'
        ], 401);
    }

    public function postRegister(AuthRequest $request, User $user)
    {
        $isRegistered = $this->authService->postRegister($request, $user);
        if ($isRegistered) {
            $users = User::all();
            foreach ($users as $userNotify) {
                $userNotify->notify(new NewUser($user, 'Có khách hàng mới vừa đăng kí tài khoản', 'khách hàng mới'));
            }

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
        $user->phone = $request->input('phone');
        $data = $request->except('avatar');
        $data['avatar'] = $user->avatar;
        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }
        $user->avatar = $data['avatar'];
        $user->save();
        return response()->json(['success' => true, 'message' => 'Thông tin đã được cập nhật thành công!', 'avatar' => Storage::url($user->avatar)]);
    }

    public function updatePassword(AuthRequest $request)
    {
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['success' => false, 'message' => 'Mật khẩu hiện tại không đúng'], 422);
        }
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
        return response()->json(['success' => true, 'message' => 'Mật khẩu đã được cập nhật thành công!']);
    }
}
