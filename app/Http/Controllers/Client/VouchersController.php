<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UserVoucher;
use App\Models\Voucher;
use App\Services\UserService;
use App\Events\VoucherOutOfStock;
use App\Events\VoucherSaved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        $currentUser = $this->userService->getCurrentUser();
        return view('client.my-account.vouchers', compact( 'currentUser', ));
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
            'saved_at' => now(),
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

}
