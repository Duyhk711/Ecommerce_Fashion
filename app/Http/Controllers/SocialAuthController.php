<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // Kiểm tra xem người dùng có tồn tại trong cơ sở dữ liệu không
        $authUser = User::where('email', $user->getEmail())->first();

        if ($authUser) {
            Auth::login($authUser);
        } else {
            // Tạo người dùng mới nếu chưa tồn tại
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'facebook_id' => $user->getId(), // Thêm cột này vào bảng users
                'avatar' => $user->getAvatar(),
                'password' => bcrypt('password'), // Tạo một mật khẩu giả, nếu không có mật khẩu
            ]);

            Auth::login($newUser);
        }

        return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
    }
}
