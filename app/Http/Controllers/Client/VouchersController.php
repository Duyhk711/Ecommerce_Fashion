<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SavedVoucher;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Đảm bảo có dòng này

class VouchersController extends Controller
{ public function voucher()
    {
        // Bạn có thể thêm logic xử lý để lấy dữ liệu voucher từ database nếu cần
        return view('client.my-account.vouchers');
    }

    public function saveVoucher(Request $request)
    {
        // Kiểm tra và xác thực dữ liệu
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        // Kiểm tra xem voucher có tồn tại không
        $voucher = Voucher::where('code', $request->code)->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Voucher không tồn tại.']);
        }

        try {
            // Lưu voucher vào bảng user_voucher
            UserVoucher::create([
                'user_id' => Auth::id(), // Lưu ID người dùng
                'voucher_id' => $voucher->id,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi khi lưu voucher: ' . $e->getMessage()]);
        }
    }
}
