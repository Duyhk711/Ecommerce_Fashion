<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Voucher;

class VoucherStatisticController extends Controller
{
    protected function applyDateFilter(Request $request, $query, $tableAlias = null, $dateColumn = 'created_at')
    {
        // Xác định tên cột cần lọc (mặc định là `created_at`, có thể truyền vào cột khác như `updated_at`)
        $dateColumn = $tableAlias ? "{$tableAlias}.{$dateColumn}" : $dateColumn;

        // Nhận tham số từ request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Lọc theo khoảng thời gian nếu cả start_date và end_date đều có
        if ($startDate && $endDate) {
            $query->whereBetween($dateColumn, [$startDate, $endDate]);
        }

        return $query;
    }


    // tỉ lệ sử dụng
    public function getVoucherUsageRate(Request $request)
    {
        $query = DB::table('vouchers');

        // Đếm tổng số vé
        $totalVouchers = (clone $query)->count();

        // Đếm số vé đã sử dụng từ bảng 'user_voucher' với bộ lọc thời gian cho bảng này
        $usedVouchers = DB::table('vouchers')
            ->join('user_voucher', 'user_voucher.voucher_id', '=', 'vouchers.id')
            ->where('user_voucher.is_used', '>', 0);

        // Áp dụng bộ lọc thời gian cho bảng 'user_voucher' (với cột 'updated_at')
        $this->applyDateFilter($request, $usedVouchers, 'user_voucher', 'updated_at');

        $usedVouchers = $usedVouchers->count();

        // Tính tỷ lệ sử dụng vé
        $usageRate = $totalVouchers > 0 ? ($usedVouchers / $totalVouchers) * 100 : 0;

        return response()->json([
            'total_vouchers' => $totalVouchers,
            'used_vouchers' => $usedVouchers,
            'usage_rate' => round($usageRate, 2),
        ]);
    }


    // doanh thu
    public function getTotalRevenue(Request $request)
    {
        // Create queries for orders with and without vouchers
        $queryWithVoucher = Order::whereNotNull('voucher_id');
        $queryWithoutVoucher = Order::whereNull('voucher_id');

        // Apply the date filter correctly
        $queryWithVoucher = $this->applyDateFilter($request, $queryWithVoucher, 'orders', 'updated_at');
        $queryWithoutVoucher = $this->applyDateFilter($request, $queryWithoutVoucher, 'orders', 'updated_at');

        // Calculate the revenue with and without vouchers
        $revenueWithVoucher = $queryWithVoucher->sum('total_price');
        $revenueWithoutVoucher = $queryWithoutVoucher->sum('total_price');

        // Return the revenue data as JSON
        return response()->json([
            'revenue_with_voucher' =>  round($revenueWithVoucher, 0) * 1000,
            'revenue_without_voucher' => round($revenueWithoutVoucher, 0) * 1000,
        ]);
    }

    // độ hiệu quả
    public function getDiscountStatistics(Request $request)
    {
        // Filter logic for effectiveness of vouchers
        $totalDiscountOrdersQuery = Order::whereNotNull('voucher_id');
        $totalDiscountOrdersQuery = $this->applyDateFilter($request, $totalDiscountOrdersQuery);

        $discountOrders = $totalDiscountOrdersQuery->get();
        $totalDiscountRevenue = $discountOrders->sum('total_price');

        $totalDiscountProfit = $discountOrders->reduce(function ($carry, $order) {
            return $carry + (0.5 * $order->total_price);
        }, 0);

        $vouchers = Voucher::all();

        $statistics = $vouchers->map(function ($voucher) use ($totalDiscountRevenue, $totalDiscountProfit, $request) {
            $ordersQuery = Order::where('voucher_id', $voucher->id);
            $ordersQuery = $this->applyDateFilter($request, $ordersQuery, 'orders', 'updated_at');

            $orders = $ordersQuery->get();
            $revenue = $orders->sum('total_price');
            $profit = $orders->reduce(function ($carry, $order) {
                return $carry + (0.5 * $order->total_price);
            }, 0);

            $usageCount = $orders->count();
            if ($usageCount < 1) return null;

            $revenueEffectiveness = $totalDiscountRevenue > 0 ? ($revenue / $totalDiscountRevenue) * 100 : 0;
            $profitEffectiveness = $totalDiscountProfit > 0 ? ($profit / $totalDiscountProfit) * 100 : 0;

            $effectivenessScore = (0.5 * $revenueEffectiveness) + (0.2 * $profitEffectiveness);

            // Determine the discount type text
            $discountType = $voucher->discount_type == 'percentage' ? 'Giảm theo %' : 'Số tiền cố định';
            $formattedRevenue = number_format($revenue * 1000, 0, '.', '.');
            $formattedProfit = number_format($profit * 1000, 0, '.', '.');

            return [
                'id' => $voucher->id,
                'code' => $voucher->code,
                'usage_count' => $usageCount,
                'revenue' => round($formattedRevenue, 0),
                'profit' => round($formattedProfit, 0),
                'effectiveness' => round($effectivenessScore, 2),
                'start_date' => \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y'),
                'end_date' => \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y'),
                'discount_type' => $discountType,
            ];
        })->sortByDesc('effectiveness');

        return response()->json($statistics->filter()->values());
    }

}
