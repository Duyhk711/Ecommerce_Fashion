<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function info()
    {
        $userId = auth()->id();
        $currentUser = $this->userService->getCurrentUser();
        $totalOrder = $this->userService->getTotalOrders();
        $defaultAddress = $this->userService->getDefaultAddress($userId);

        return view('client.my-account.account-info', compact('currentUser', 'totalOrder','defaultAddress'));
    }
    public function address()
    {
        $addresses = $this->userService->getAllAddresses();
        return view('client.my-account.address', compact('addresses'));
    }
    public function myOrder()
    {
        return view('client.my-account.my-order');
    }
    public function orderTracking()
    {
        return view('client.my-account.oder-tracking');
    }
    public function myWishlist()
    {
        return view('client.my-account.my-wishlist');
    }
    public function profile()
    {
        $userId = auth()->id();
        $defaultAddress = $this->userService->getDefaultAddress($userId);
        $currentUser = $this->userService->getCurrentUser();
        return view('client.my-account.profile', compact('currentUser','defaultAddress'));
    }

    //lưu địa chỉ
    public function storeAddress(StoreAddressRequest $request)
    {
        $data = $request->only([
            'customer_name',
            'customer_phone',
            'address_line1',
            'address_line2',
            'ward',
            'district',
            'city',
            'type',
        ]);

        // Lưu địa chỉ và nhận thông tin địa chỉ đã lưu
        $address = $this->userService->storeAddress($data);

        return response()->json([
            'success' => true,
            'address' => $address
        ]);
    }

    //set địa chỉ mặc định
    public function setDefault($id)
    {
        $this->userService->setDefaultAddress($id);

        return response()->json([
            'success' => true,
            'message' => 'Địa chỉ mặc định đã được cập nhật.'
        ]);
    }
    public function destroy($id)
    {
        // Gọi phương thức deleteAddress từ AddressService
        $deleted = $this->userService->deleteAddress($id);

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Địa chỉ đã được xóa thành công.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Địa chỉ không tồn tại.'
            ], 404);
        }
    }
    public function updateProfile(AuthRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        $this->userService->updateProfile($data, $user);

        return redirect()->back()->with('message', 'Cập nhật thông tin thành công!');
    }
}
