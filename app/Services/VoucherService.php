<?php

namespace App\Services;

use App\Models\Voucher;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class VoucherService
{
    public function getAllVouchers()
    {
        return Voucher::all();
    }
    public function storeVoucher(array $data)
    {
        // Xác thực dữ liệu đầu vào
        // $this->validateVoucherData($data);

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
            'start_date' => $data['start_date'],  // Dữ liệu dạng datetime
            'end_date' => $data['end_date'],      // Dữ liệu dạng datetime
        ]);
    }




    public function updateVoucher(Voucher $voucher, array $data)
    {
        return $voucher->update([
            'code' => $data['code'],
            'discount_type' => $data['discount_type'],
            'discount_value' => $data['discount_value'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
    }

    public function deleteVoucher(Voucher $voucher)
    {
        // Xóa vĩnh viễn voucher
        return $voucher->forceDelete();
    }
}
