<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VouchersController extends Controller
{
    public function voucher()
    {
        // Bạn có thể thêm logic xử lý để lấy dữ liệu voucher từ database nếu cần
        return view('client.my-account.vouchers');
    }
    public function index()
    {
        $vouchers = Voucher::all(); // Lấy tất cả các voucher từ database
        return view('client.vouchers', compact('vouchers')); // Trả về view với biến vouchers
    }

    public function save(Request $request)
    {
        // Kiểm tra và xác thực dữ liệu từ frontend
        $request->validate([
            'code' => 'required|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Lưu voucher nếu chưa tồn tại
        $voucher = Voucher::firstOrCreate(
            ['code' => $request->input('code')],
            [
                'discount_type' => $request->input('discount_type'),
                'discount_value' => $request->input('discount_value'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date')
            ]
        );

        // Lưu quan hệ giữa người dùng và voucher vào bảng user_voucher
        $user = Auth::user(); // Lấy người dùng hiện tại

        UserVoucher::updateOrCreate(
            [
                'user_id' => $user->id,
                'voucher_id' => $voucher->id
            ],
            [
                'saved_at' => now(),
                'is_used' => false
            ]
        );

        // Trả về phản hồi JSON hoặc redirect
        return redirect()->back()->with('success', 'Lưu thành công!');
    }

}
