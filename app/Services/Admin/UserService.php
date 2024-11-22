<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Http\Request;

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

}
