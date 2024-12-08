<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Order;
use App\Models\User;
use App\Services\Admin\UserService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

    public function getAllRole()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        // dd($users);
        return view('admin.users.role.index', compact('roles'));
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Role::create(['name' => $request->input('name')]);

        return redirect()->back()
            ->with('success', 'Thêm vai trò thành công');

    }

    public function editRole(Role $role)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.users.role.edit', compact('role', 'roles'));
    }

    public function updateRole(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role->name = $request->input('name');
        $role->save();
        return redirect()->back()
            ->with('success', 'Sửa vai trò thành công');

    }

    public function getAllPermissionRole(Role $role)
    {
        $permission = Permission::orderBy('id', 'DESC')->get();
        $permissionsOfRole = $role->permissions;
        return view('admin.users.role.permission', compact('role', 'permission', 'permissionsOfRole'));
    }

    public function updatePermissionRole(Request $request, Role $role)
    {
        // dd($request->input('permission'));
        $role->syncPermissions($request->input('permission'));
        return redirect()->back()
            ->with('success', 'thêm quyền cho vai trò thành công');
    }

    public function deleteRole(Role $role)
    {
        if ($role) {
            // Trước khi xóa, nếu cần, xóa tất cả quyền gắn liền với Role
            $role->permissions()->detach(); // Detach các quyền nếu không cần giữ lại

            // Xóa Role
            $role->delete();

            return redirect()->back()->with('success', 'Xóa vai trò thành công');
        } else {
            return redirect()->back()->with('error', 'Vai trò không tồn tại');
        }
    }

    public function getAllClient()
    {
        $users = $this->userService->getAllClient();
        // dd($users);
        return view('admin.users.client.index', compact('users'));
    }

    public function getAllStaff()
    {
        $users = $this->userService->getAllAdmin();
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.users.staff.index', compact('users', 'roles'));
    }

    public function createStaff()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.users.staff.create', compact('roles'));
    }

    public function editStaff(User $user)
    {
        // dd($user);
        $user_role = $user->roles->first();
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.users.staff.edit', compact('roles', 'user', 'user_role'));
    }

    public function storeStaff(AuthRequest $request)
    {
        $isRegistered = $this->userService->storeStaff($request);
        if ($isRegistered) {
            return redirect()->route('admin.users.staffs')->with('success', 'Tạo mới thành công');
        }
        return redirect()->back()->with('error', 'Lỗi.');
    }
    public function updateStaff(AuthRequest $request, User $user)
    {
        // dd($user, $request->all());
        $isRegistered = $this->userService->updateStaff($request, $user);
        if ($isRegistered) {
            return redirect()->route('admin.users.staffs')->with('success', 'Tạo mới thành công');
        }
        return redirect()->back()->with('error', 'Lỗi.');
    }

    public function updateQuicklyRole(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->syncRoles($request->input('role'));

            $user->save();

            return redirect()->back()->with('success', 'Thay đổi vai trò thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Vai trò đơn hàng đã được cập nhật.');
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

            return redirect()->back()
                ->with('success', 'Người dùng đã bỏ kích hoạt thành công');
        } else {
            $user->is_active = true;
            $user->save();

            return redirect()->back()
                ->with('success', 'Người dùng đã được kích hoạt thành công');
        }

    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công.');
    }
}
