<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Models\Favorite;
use App\Models\User;
use App\Services\Client\FavoriteService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    protected $userService;
    protected $favoriteService;

    public function __construct(UserService $userService,  FavoriteService $favoriteService)
    {
        $this->userService = $userService;
        $this->favoriteService = $favoriteService;
    }
    public function info()
    {
        $userId = auth()->id();
        $currentUser = $this->userService->getCurrentUser();
        $totalOrder = $this->userService->getTotalOrders();
        $defaultAddress = $this->userService->getDefaultAddress($userId);

        return view('client.my-account.account-info', compact('currentUser', 'totalOrder', 'defaultAddress'));
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

    // favorite
    public function add($productId)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào danh sách yêu thích.'], 403);
        }

        $userId = Auth::id();

        $favorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm này đã có trong danh sách yêu thích.']);
        }

        Favorite::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được thêm vào danh sách yêu thích.']);
    }

    // Phương thức xóa sản phẩm khỏi danh sách yêu thích
    public function remove($productId)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để xóa sản phẩm khỏi danh sách yêu thích.'], 403);
        }

        $userId = Auth::id();

        $favorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if (!$favorite) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm này không có trong danh sách yêu thích.']);
        }

        $favorite->delete();

        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi danh sách yêu thích.']);
    }
    
    // Phương thức hiển thị danh sách yêu thích
    public function myWishlist()
    {
        $favorites = $this->favoriteService->getFavorites();
        return view('client.my-account.my-wishlist', compact('favorites'));
    }

    public function profile()
    {
        $userId = auth()->id();
        $defaultAddress = $this->userService->getDefaultAddress($userId);
        $currentUser = $this->userService->getCurrentUser();
        return view('client.my-account.profile', compact('currentUser', 'defaultAddress'));
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
