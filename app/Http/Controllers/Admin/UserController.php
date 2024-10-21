<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    protected $userService;

    const PATH_VIEW = 'admin.users.';

    public function __construct(UserService $userService, )
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUser();
        return view(Self::PATH_VIEW . __FUNCTION__, compact('users'));
    }

    public function create()
    {
        return view(Self::PATH_VIEW . __FUNCTION__);
    }

    public function store(AuthRequest $request, User $user)
    {
        $isRegistered = $this->userService->storeUser($request, $user);
        if ($isRegistered) {
            return redirect()->route('admin.users.index')->with('success', 'Tạo mới thành công');
        }
        return redirect()->back()->with('error', 'Lỗi.');
    }

    public function show(User $user)
    {
        return view(Self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    public function edit(User $user)
    {
        return view(Self::PATH_VIEW . __FUNCTION__, compact('user'));
    }

    public function active(User $user)
    {
        if ($user->is_active == 1) {
            $user->is_active = false;
            $user->save();

            return redirect()->route('admin.users.index')
                ->with('success', 'Người dùng đã bỏ kích hoạt thành công');
        } else {
            $user->is_active = true;
            $user->save();

            return redirect()->route('admin.users.index')
                ->with('success', 'Người dùng đã được kích hoạt thành công');
        }

    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công.');
    }
}