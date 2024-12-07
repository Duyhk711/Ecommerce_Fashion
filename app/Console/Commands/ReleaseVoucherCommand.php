<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Carbon\Carbon;

class ReleaseVoucherCommand extends Command
{
    protected $signature = 'voucher:release';
    protected $description = 'Giải phóng voucher không sử dụng sau 2 tiếng kể từ lúc lưu';

    public function handle()
    {
        $twoHoursAgo = now()->subHours(2);
        // Lấy danh sách UserVoucher đủ điều kiện giải phóng
        $userVouchers = UserVoucher::where('created_at', '<=', $twoHoursAgo)
            ->whereHas('voucher', function ($query) {
                $query->whereColumn('user_voucher.is_used', '<', 'vouchers.usage_limit');
            })
            ->get();

        foreach ($userVouchers as $userVoucher) {
            // Cập nhật số lượng voucher còn lại trong bảng vouchers
            $voucher = $userVoucher->voucher;
            if ($voucher) {
                $voucher->quantity++;
                $voucher->save();
            }
            $userVoucher->delete();
        }

        $this->info('Giải phóng voucher thành công sau 2 tiếng và xóa bản ghi trong bảng user_vouchers!');
    }
}
