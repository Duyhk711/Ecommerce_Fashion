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
}
