<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function getAllUser()
    {
        return User::all();
    }

    public function getAllClient()
    {
        return User::where('role', 'user')->get();
    }

    public function getAllAdmin()
    {
        return User::where('role', 'admin')->where('id', '<>', auth()->user()->id)->get();
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }

    public function storeStaff(Request $request)
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

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->avatar = $request->input('avatar');
        $user->phone = $request->input('phone');
        $user->role = 'admin';
        if ($request->input('role') != '') {
            $user->syncRoles($request->input('role'));
        }
        $user->save();
        if ($user) {
            return true;
        }
        return false;
    }
    public function updateStaff(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->except('avatar');
        $data['avatar'] = '';
        // if ($request->hasFile('avatar')) {
        //     $avatarPath = $request->file('avatar')->store('avatars', 'public');
        //     $data['avatar'] = $avatarPath;
        // }
        if ($request->hasFile('avatar')) {
            // Xóa ảnh bìa cũ nếu có
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Tải ảnh bìa mới lên
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            // $request->merge(['avatar' => $avatarPath]);

            $user->avatar = $avatarPath;
        }

        // $user = new User();
        $user->name = $request->input('name');
        if ($user->email != $request->input('email')) {

            $user->email = $request->input('email');
        }
        $user->phone = $request->input('phone');
        if ($request->input('role') != '') {
            $user->syncRoles($request->input('role'));
        }
        // dd($user, $request->all());
        $user->save();
        if ($user) {

            return true;
        }
        return false;
    }

}
