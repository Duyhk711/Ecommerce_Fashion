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
            case 'admin.postAdminLogin':
                return $this->loginRules();
            case 'admin.send-otp':
                return $this->otpRules();
            case 'admin.verify-otp.post':
                return $this->verifyOtpRules();
            case 'admin.reset-password.post':
                return $this->resetPasswordRules();
            case 'admin.update-profile':
                return $this->profileRules();
            case 'admin.update-password':
                return $this->updatePasswordRules();
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
            'phone.regex' => 'Số điện thoại phải có 10 chữ số và chỉ chứa các số từ 0-9.',
            'avatar.image' => 'Avatar phải là một tệp hình ảnh.',
            'avatar.mimes' => 'Avatar phải có định dạng jpeg, png, jpg, gif.',
            'avatar.max' => 'Kích thước tệp Avatar không được vượt quá 2MB.',
            'current_password.required' => 'Mật khẩu hiện tại là bắt buộc.',
            'current_password.current_password' => 'Mật khẩu hiện tại không chính xác.',
            'new_password.required' => 'Mật khẩu mới là bắt buộc.',
            'new_password.min' => 'Mật khẩu mới phải chứa ít nhất :min ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu không khớp.',
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
    public function profileRules()
    {
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $this->user()->id,
        'phone' => 'nullable|regex:/^[0-9]{10}$/',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];  
    }

    public function updatePasswordRules()
    {
        return [
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }
}
