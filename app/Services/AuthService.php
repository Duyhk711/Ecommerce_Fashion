<?php

namespace App\Services;

use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthService
{
    private $sidKey;
    private $secretKey;

    public function __construct()
    {
        $this->sidKey = env('STRINGEE_SID_KEY');
        $this->secretKey = env('STRINGEE_SECRET_KEY');
    }

    public function postLogin(Request $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            return true;
        }
        return false;
    }
    public function postRegister(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->except('avatar');
        $data['avatar'] = '';
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }
        $user->query()->create($data);
        if ($user) {
            return true;
        }
        return false;
    }
    public function logout()
    {
        Auth::logout();
    }
    public function sendOtp($email)
    {
        $otp = rand(100000, 999999);
        Session::put('otp', $otp);
        Session::put('email', $email);
        Session::put('otp_expires_at', now()->addMinutes(1));
        Mail::to($email)->send(new OtpMail($otp));

        return $otp;
    }
    public function resendOtp($email)
    {
        // Sinh mã OTP
        $otp = rand(100000, 999999);
        Session::put('otp', $otp);
        Session::put('email', $email);
        Session::put('otp_expires_at', now()->addMinutes(1));
        Mail::to($email)->send(new OtpMail($otp));

        return ['success' => true, 'message' => 'Mã OTP đã được gửi lại!'];
    }
    public function resendOtp_mail($email)
    {
        // Sinh mã OTP
        $otp = rand(100000, 999999);
        Session::put('otp', $otp);
        Session::put('email', $email);
        Session::put('otp_expires_at', now()->addMinutes(1));
        Mail::to($email)->send(new OtpMail($otp));

        return ['success' => true, 'message' => 'Mã OTP đã được gửi lại!'];
    }
    public function verifyOtp($otp)
    {
        $storedOtp = Session::get('otp');
        $otpExpiresAt = Session::get('otp_expires_at');
        if (!$storedOtp || $storedOtp != $otp) {
            return false;
        }
        if (now()->greaterThan($otpExpiresAt)) {
            return false;
        }
        Session::forget('otp');
        Session::forget('otp_expires_at');

        return true;
    }
    public function getEmailFromSession()
    {
        return Session::get('email');
    }
    public function setEmailToSession($email)
    {
        Session::put('email', $email);
    }
    public function updatePassword($email, $password)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->password = bcrypt($password);
            $user->save();
            return true;
        }
        return false;
    }
    //admin
    public function postAdminLogin(Request $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return true;
            } else {
                Auth::logout();
                return 'not_admin';
            }
        }
        return false;
    }
    public function setPhoneToSession($phone)
    {
        Session::put('phone', $phone);
    }

    public function getPhoneFromSession()
    {
        return Session::get('phone');
    }

    public function sendOtpPhone(string $phone, string $otp)
    {
        $url = 'https://api.stringee.com/v1/sms';

        $response = Http::withBasicAuth($this->sidKey, $this->secretKey)
            ->post($url, [
                'from' => 'OTP phone',
                'to' => $phone,
                'text' => "Mã OTP của bạn là: $otp",
            ]);

        return $response->successful();
    }
}
