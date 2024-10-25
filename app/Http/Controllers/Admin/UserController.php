<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Order;
use App\Models\User;
use App\Services\Admin\UserService;
use App\Services\OrderService;

class UserController extends Controller
{
    protected $userService;
    protected $orderService;

    const PATH_VIEW = 'admin.users.';

    public function __construct(UserService $userService, OrderService $orderService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
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
        // dd($user);
        $totalOrders = Order::where('user_id', $user->id)->count();
        $totalOrderValue = Order::where('user_id', $user->id)->sum('total_price');
        $orders = Order::where('user_id', $user->id)->get();
        // dd($orders);
        return view(Self::PATH_VIEW . __FUNCTION__, compact('user', 'totalOrders', 'totalOrderValue', 'orders'));
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
