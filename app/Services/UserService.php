<?php

namespace App\Services;

use App\Http\Requests\AuthRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function getAllAddresses()
    {
        // Giả sử bạn muốn lấy danh sách địa chỉ của người dùng đang đăng nhập
        $userId = Auth::id();
        return Address::where('user_id', $userId)->get();
    }

    //lấy địa chỉ theo id
   public function getAddressById($id)
    {
        // Tìm địa chỉ theo ID
        return Address::find($id); // Sử dụng Eloquent để tìm địa chỉ
    }

    //them moi dia chi
    public function storeAddress(array $data)
    {
        return Address::create([
            'user_id' => auth()->id(), // Lấy user_id của người dùng hiện tại
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'address_line1' => $data['address_line1'],
            'address_line2' => $data['address_line2'] ?? null,
            'ward' => $data['ward'],
            'district' => $data['district'],
            'city' => $data['city'],
            'type' => $data['type'],
        ]);
    }

    //set địa chỉ măcj định
    public function setDefaultAddress($addressId)
    {
        Address::where('user_id', Auth::id())->update(['is_default' => false]);
        return Address::where('id', $addressId)->update(['is_default' => true]);
    }

    //lấy địa chỉ mặc định
    public function getDefaultAddress($userId)
    {
        return Address::where('user_id', $userId)
            ->where('is_default', true)
            ->first();
    }

    public function deleteAddress(int $id)
    {
        $address = Address::find($id);
        if ($address) {
            return $address->delete();
        }
        return false;
    }

    //sửa địa chỉ
    public function updateAddress(int $addressId, array $data)
    {
        $address = Address::find($addressId);
        if ($address && $address->user_id === auth()->id()) {
            return $address->update([
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'address_line1' => $data['address_line1'],
                'address_line2' => $data['address_line2'] ?? $address->address_line2,
                'ward' => $data['ward'],
                'district' => $data['district'],
                'city' => $data['city'],
                'type' => $data['type'],
            ]);
        }

        return false;
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function getTotalOrders()
    {
        $userId = Auth::id();
        return Order::where('user_id', $userId)->count();
    }

    public function updateProfile(array $data, User $user)
    {
        $old_avatar = $user->avatar;
        if (isset($data['avatar'])) {
            $data['avatar'] = $data['avatar']->store('avatars', 'public');
            if ($old_avatar && Storage::disk('public')->exists($old_avatar)) {
                Storage::disk('public')->delete($old_avatar);
            }
        } else {
            $data['avatar'] = $old_avatar;
        }
        return $user->update($data);
    }
}
