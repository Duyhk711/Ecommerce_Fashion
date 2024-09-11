<?php

namespace App\Services;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function postLogin(Request $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            return true;
        }
        return false;
    }
    public function postRegister(Request $request,User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data=$request->except('avatar');
        // Xử lý file avatar nếu có
        $data['avatar'] = '';
        if ($request->hasFile('avatar')) {
            // Lưu file avatar vào storage (thư mục public/avatars)
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        // Tạo người dùng mới
        $user->query()->create($data);

        // Nếu người dùng được tạo thành công, trả về true
        if ($user) {
            return true;
        }

        // Nếu không thành công, trả về false
        return false;
    }
    public function logout()
    {
        Auth::logout();
    }
    public function sendOtp($email)
    {
        // Tạo mã OTP ngẫu nhiên
        $otp = rand(100000, 999999);

        // Lưu OTP và email vào session với thời gian sống là 5 phút
        Session::put('otp', $otp);
        Session::put('email', $email);
        Session::put('otp_expires_at', now()->addMinutes(5));

        // Gửi OTP qua email
        Mail::to($email)->send(new OtpMail($otp));

        return $otp;
    }
    public function verifyOtp($otp)
    {
        // Lấy mã OTP và thời gian hết hạn từ session
        $storedOtp = Session::get('otp');
        $otpExpiresAt = Session::get('otp_expires_at');

        // Kiểm tra mã OTP và thời gian sống
        if (!$storedOtp || $storedOtp != $otp) {
            return false; // Mã OTP không hợp lệ
        }

        if (now()->greaterThan($otpExpiresAt)) {
            return false; // OTP đã hết hạn
        }

        // Xác minh thành công, xóa OTP khỏi session nhưng giữ email
        Session::forget('otp');
        Session::forget('otp_expires_at');

        return true;
    }


    // Lấy email liên quan đến OTP từ session
    public function getEmailFromSession()
    {
        return Session::get('email');
    }
}

