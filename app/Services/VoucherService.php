<?php

namespace App\Services;

use App\Mail\NewVoucherMail;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class VoucherService
{
    public function getAllVouchers()
    {
        return Voucher::orderBy('created_at', 'desc')->get();
    }

    public function storeVoucher(array $data)
    {
        // Kiểm tra trùng lặp mã
        $existingVoucher = Voucher::where('code', $data['code'])->first();
        if ($existingVoucher) {
            throw new \Exception('Mã giảm giá đã tồn tại.');
        }

        // Tạo voucher mới
        return Voucher::create([
            'code' => $data['code'],
            'discount_type' => $data['discount_type'],
            'discount_value' => $data['discount_value'],
            'minimum_order_value' => $data['minimum_order_value'],
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'quantity' => $data['quantity'] ?? 0, // Thêm trường số lượng, mặc định là 0 nếu không có
        ]);
    }

    public function updateVoucher(Voucher $voucher, array $data)
{
    // Kiểm tra trùng lặp mã, nhưng loại trừ mã hiện tại
    $existingVoucher = Voucher::where('code', $data['code'])
        ->where('id', '!=', $voucher->id) // Đảm bảo không kiểm tra chính nó
        ->first();

    if ($existingVoucher) {
        throw new \Exception('Mã giảm giá đã tồn tại.');
    }

    return $voucher->update([
        'code' => $data['code'],
        'discount_type' => $data['discount_type'],
        'discount_value' => $data['discount_value'],
        'description' => $data['description'],
        'minimum_order_value' => $data['minimum_order_value'],
        'start_date' => $data['start_date'],
        'end_date' => $data['end_date'],
        'quantity' => $data['quantity'] ?? $voucher->quantity,
    ]);
}


    public function deleteVoucher(Voucher $voucher)
    {
        // Xóa vĩnh viễn voucher
        return $voucher->forceDelete();
    }
    public function toggleActiveStatus(Voucher $voucher)
    {
        $voucher->is_active = 1; // Kích hoạt voucher
        $voucher->save();
    }

    public function toggleDeactiveStatus(Voucher $voucher)
    {
        $voucher->is_active = 0; // Hủy kích hoạt voucher
        $voucher->save();
    }

    public function sendNewVoucherNotification($voucher)
    {
        $customers = User::all();
        foreach ($customers as $customer) {
            Mail::to($customer->email)->queue(new NewVoucherMail($customer, $voucher));
        }
    }
}
