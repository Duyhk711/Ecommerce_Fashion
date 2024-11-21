<?php

namespace App\Http\Controllers\Client;

use App\Events\VoucherOutOfStock;
use App\Events\VoucherSaved;
use App\Http\Controllers\Controller;
use App\Models\UserVoucher;
use App\Models\Voucher;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VouchersController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function voucher()
    {
        $pageTitle = 'Mã ưu đãi';
        $currentUser = $this->userService->getCurrentUser();
        return view('client.my-account.vouchers', compact('currentUser', ));
    }
    public function index()
    {
        return view('client.vouchers');
    }

    public function loadAllVouchers()
    {
        $userId = Auth::id();
        $currentDate = now();

        $vouchers = Voucher::where('is_active', 1)
            ->where('end_date', '>', $currentDate)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($vouchers as $voucher) {
            $voucher->is_out_of_stock = $voucher->used_quantity >= $voucher->quantity;
            $voucher->is_saved = UserVoucher::where('user_id', $userId)
                ->where('voucher_id', $voucher->id)
                ->exists();
        }

        return response()->json($vouchers);
    }

    public function getAllVouchers()
    {
        $userId = Auth::id();
        $currentDate = now();

        $vouchers = Voucher::where('is_active', 1)
            ->where('end_date', '>', $currentDate)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        foreach ($vouchers as $voucher) {
            $voucher->is_out_of_stock = $voucher->used_quantity >= $voucher->quantity;
            $voucher->is_saved = UserVoucher::where('user_id', $userId)
                ->where('voucher_id', $voucher->id)
                ->exists();
        }

        return response()->json($vouchers);
    }

    public function save(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $user = Auth::user();

        return DB::transaction(function () use ($request, $user) {
            $voucher = Voucher::where('code', $request->input('code'))->lockForUpdate()->first();

            if (!$voucher) {
                return response()->json(['success' => false, 'message' => 'Voucher không tồn tại.']);
            }

            if ($voucher->quantity <= 0) {
                return response()->json(['success' => false, 'message' => 'Voucher đã hết số lượng.']);
            }

            $existingVoucher = UserVoucher::where('user_id', $user->id)
                ->where('voucher_id', $voucher->id)
                ->first();

            if ($existingVoucher) {
                return response()->json(['success' => false, 'message' => 'Voucher này đã được lưu.']);
            }

            UserVoucher::create([
                'user_id' => $user->id,
                'voucher_id' => $voucher->id,
                'is_used' => false
            ]);

            $voucher->decrement('quantity');

            if ($voucher->quantity == 0) {
                broadcast(new VoucherOutOfStock($voucher));
            }
            broadcast(new VoucherSaved($voucher->id));
            return response()->json(['success' => true, 'message' => 'Lưu thành công!']);
        });
    }
    public function getMyVoucher()
    {
        $userId = Auth::id();

        $userVouchers = UserVoucher::where('user_id', $userId)
            ->with('voucher')
            ->get();

        if ($userVouchers->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Không có voucher nào đã lưu.']);
        }

        return response()->json([
            'success' => true,
            'vouchers' => $userVouchers->map(function ($userVoucher) {
                return [
                    'id' => $userVoucher->voucher->id,
                    'code' => $userVoucher->voucher->code,
                    'description' => $userVoucher->voucher->description,
                    'discount_type' => $userVoucher->voucher->discount_type,
                    'discount_value' => $userVoucher->voucher->discount_value,
                    'minimum_order_value' => $userVoucher->voucher->minimum_order_value,
                    'expiry_date' => $userVoucher->voucher->end_date,
                    'is_used' => $userVoucher->is_used,
                ];
            })
        ]);
    }
  
  public function getAvailableVouchers()
    {
        $user = Auth::user();

        // Lấy các mã giảm giá khả dụng cho người dùng hiện tại
        $vouchers = Voucher::join('user_voucher', 'vouchers.id', '=', 'user_voucher.voucher_id')
            ->where('user_voucher.user_id', $user->id)
            ->where('user_voucher.is_used', 0)
            ->where('vouchers.is_active', 1)
            ->whereDate('vouchers.start_date', '<=', now())
            ->whereDate('vouchers.end_date', '>=', now())
            ->select('vouchers.code', 'vouchers.discount_type', 'vouchers.discount_value', 'vouchers.minimum_order_value')
            ->get();
        // dd($vouchers);
        return response()->json($vouchers);
    }

    public function applyCoupon(Request $request)
    {
        $userId = auth()->id();
        $code = $request->input('code');
        $orderTotal = $request->input('order_total'); // Tổng đơn hàng

        // Kiểm tra mã giảm giá có tồn tại, khả dụng và chưa được sử dụng
        $voucher = Voucher::where('code', $code)
            ->where('is_active', 1)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('is_used', 0); // Chỉ lấy mã giảm giá chưa được sử dụng
            })
            ->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Mã giảm giá không hợp lệ hoặc đã được sử dụng.']);
        }

        // Tính toán giảm giá
        $discount = $voucher->discount_type === 'percentage' ?
        (round($orderTotal * ($voucher->discount_value / 100), 2)) :
        $voucher->discount_value;

        // Đảm bảo rằng giảm giá không vượt quá tổng đơn hàng
        $discount = min($discount, $orderTotal);

        // Cập nhật voucher đã dùng trong bảng trung gian `user_voucher`
        // $voucher->users()->updateExistingPivot($userId, ['is_used' => 1]);

        return response()->json(['success' => true, 'discount' => $discount, 'voucher_id' => $voucher->id]);
    }

}
