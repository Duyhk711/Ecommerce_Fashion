<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Services\StringeeService;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    // protected $stringeeService;

    // public function __construct(StringeeService $stringeeService)
    // {
    //     $this->stringeeService = $stringeeService;
    // }

    public function sendOtp(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Email không tồn tại trong hệ thống.']);
        }

        $this->authService->setEmailToSession($email);
        $this->authService->sendOtp($email);

        return response()->json(['success' => true, 'message' => 'OTP đã được gửi tới email của bạn.']);
    }


    // Phương thức để xác thực OTP
    public function verifyOtp(Request $request)
    {
        $otp = $request->input('otp');

        // Lấy OTP từ session
        $sessionOtp = session('otp');
        $email = session('email');

        if (!$sessionOtp || !$email) {
            return redirect()->route('login')->with('error', 'Phiên của bạn đã hết hạn. Vui lòng thử lại.');
        }

        // Kiểm tra mã OTP
        if ($otp == $sessionOtp) {
            // OTP hợp lệ, đăng nhập người dùng
            $user = User::where('email', $email)->first();
            Auth::login($user);

            // Xóa OTP khỏi session
            session()->forget(['otp', 'email']);

            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Mã OTP không chính xác. Vui lòng thử lại.');
        }   
    }
     // Hiển thị form đăng nhập OTP qua email
     public function loginOtpEmail()
     {
         return view('client.login-email-otp'); // Cần tạo view login-otp-email.blade.php
     }

     // Xử lý gửi OTP qua email và xác minh
     public function verifyOtpEmail(Request $request)
     {
         // Giả sử bạn có hệ thống gửi OTP qua email và lưu OTP trong session
         $otp = $request->input('otp');
         $email = $request->input('email');

         if ($otp == session('otp_email') && $email == session('otp_email_address')) {
             // OTP đúng, xử lý đăng nhập
             // Tìm user theo email
             $user = User::where('email', $email)->first();
             if ($user) {
                 Auth::login($user);
                 return redirect()->route('home')->with('success', 'Đăng nhập thành công');
             }
         }

         return back()->with('error', 'OTP không hợp lệ');
     }

     // Hiển thị form đăng nhập OTP qua điện thoại
     public function loginOtpPhone()
     {
         return view('auth.login-otp-phone'); // Cần tạo view login-otp-phone.blade.php
     }
}
