<?php

namespace App\Services\Admin;

use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function getAllUser()
    {
        return User::all();
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }

    public function storeUser(Request $request, User $user)
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
   
}