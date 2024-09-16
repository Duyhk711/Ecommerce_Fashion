<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $routeName = $this->route()->getName();

        switch ($routeName) {
            case 'postLogin':
                return $this->loginRules();
            case 'postRegister':
                return $this->registerRules();
            case 'sendOtp':
                return $this->otpRules();
            case 'verifyOtp':
                return $this->verifyOtpRules();
            case 'resetPassword':
                return $this->resetPasswordRules();
            default:
                return [];
        }
    }
    public function messages()
    {
        return [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự.',
            'name.required' => 'Tên là bắt buộc.',
            'otp.required' => 'Mã OTP là bắt buộc.',
        ];
    }
    private function loginRules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
    private function registerRules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ];
    }
    private function otpRules()
    {
        return [
            'email' => 'required|email',
        ];
    }
    private function verifyOtpRules()
    {
        return [
            'otp' => 'required',
        ];
    }
    private function resetPasswordRules()
    {
        return [
            'password' => 'required|confirmed|min:8',
        ];
    }
}
