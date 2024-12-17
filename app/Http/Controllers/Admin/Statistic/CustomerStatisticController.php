<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerStatisticController extends Controller
{
    public function getOrderSuccessRate(Request $request)
    {
        // Lấy tham số lọc thời gian
        $filterType = $request->input('filter', 'all'); // Giá trị: day, week, month, year, all
        $startDate = $request->input('start_date'); // Lọc theo khoảng thời gian
        $endDate = $request->input('end_date');

        // Xây dựng truy vấn thời gian
        $timeQuery = function ($query) use ($filterType, $startDate, $endDate) {
            if ($filterType !== 'all') {
                switch ($filterType) {
                    case 'day':
                        $query->whereDate('orders.created_at', '=', now()->format('Y-m-d'));
                        break;
                    case 'week':
                        $query->whereBetween('orders.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                        break;
                    case 'month':
                        $query->whereYear('orders.created_at', '=', now()->year)
                            ->whereMonth('orders.created_at', '=', now()->month);
                        break;
                    case 'year':
                        $query->whereYear('orders.created_at', '=', now()->year);
                        break;
                }
            }

            // Lọc theo khoảng ngày cụ thể
            if ($startDate && $endDate) {
                $query->whereBetween('orders.created_at', [$startDate, $endDate]);
            }
        };

        // Tổng số khách hàng (tài khoản)
        $totalCustomers = DB::table('users')->count();

        // Số khách hàng có ít nhất 1 đơn hàng thành công
        $successfulCustomers = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('orders.status', '=', '5') // Đơn hàng thành công
            ->where($timeQuery)
            ->distinct('users.id') // Chỉ tính mỗi khách hàng 1 lần
            ->count('users.id');

        // Tính tỷ lệ chốt đơn
        $successRate = $totalCustomers > 0
            ? ($successfulCustomers / $totalCustomers) * 100
            : 0;

        return response()->json([
            'filter_type' => $filterType,
            'total_customers' => $totalCustomers,
            'successful_customers' => $successfulCustomers,
            'success_rate' => round($successRate, 2) // Làm tròn đến 2 chữ số thập phân
        ]);
    }
    /**
     * Tính toán tỷ lệ khách hàng quay lại
     */
    public function getReturningCustomerRate(Request $request)
    {
        // Lấy tham số năm từ request hoặc mặc định là năm hiện tại
        $year = $request->query('year', now()->year);

        // Query lấy danh sách khách hàng có ít nhất 1 giao dịch thành công theo năm
        $query = DB::table('orders')
            ->select('user_id', DB::raw('MIN(created_at) as first_order_date'))
            ->where('status', '5')
            ->whereYear('created_at', $year)
            ->groupBy('user_id');

        // Danh sách khách hàng có ít nhất 1 giao dịch thành công
        $successfulCustomers = $query->pluck('user_id')->toArray();

        // Tính tổng số khách hàng có ít nhất 1 giao dịch thành công
        $totalSuccessfulCustomers = count($successfulCustomers);

        // Lấy danh sách khách hàng quay lại và phân nhóm theo tháng
        $monthlyReturningCustomers = DB::table('orders')
            ->whereIn('user_id', $successfulCustomers)
            ->where('status', '5')
            ->whereRaw('DATEDIFF(created_at, (SELECT MIN(o2.created_at) FROM orders o2 WHERE o2.user_id = orders.user_id AND o2.status = "5")) >= 30')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(DISTINCT user_id) as returning_customers'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('returning_customers', 'month')
            ->toArray();

        // Tạo dữ liệu tỷ lệ quay lại theo từng tháng
        $monthlyReturnRates = [];
        for ($month = 1; $month <= 12; $month++) {
            $returningCustomers = $monthlyReturningCustomers[$month] ?? 0;
            $returnRate = $totalSuccessfulCustomers > 0
                ? ($returningCustomers / $totalSuccessfulCustomers) * 100
                : 0;

            $monthlyReturnRates[] = [
                'month' => $month,
                'return_rate' => round($returnRate, 2) // Làm tròn 2 chữ số thập phân
            ];
        }

        return response()->json([
            'year' => $year,
            'total_successful_customers' => $totalSuccessfulCustomers,
            'monthly_return_rates' => $monthlyReturnRates
        ]);
    }

    /**
     * API Tần suất mua hàng
     */
    public function getPurchaseFrequency(Request $request)
    {
        // Lấy tham số năm từ request hoặc mặc định là năm hiện tại
        $year = $request->query('year', now()->year);

        // Lấy dữ liệu tổng số đơn hàng và số khách hàng theo từng tháng
        $monthlyData = DB::table('orders')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('COUNT(DISTINCT user_id) as total_customers')
            )
            ->where('status', '5') // Lọc trạng thái đơn hàng thành công
            ->whereYear('created_at', $year) // Lọc theo năm
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Tạo dữ liệu tần suất mua hàng cho từng tháng
        $monthlyPurchaseFrequency = [];
        for ($month = 1; $month <= 12; $month++) {
            $data = $monthlyData->firstWhere('month', $month);

            $totalOrders = $data->total_orders ?? 0;
            $totalCustomers = $data->total_customers ?? 0;

            // Tính tần suất mua hàng
            $frequency = $totalCustomers > 0 ? $totalOrders / $totalCustomers : 0;

            $monthlyPurchaseFrequency[] = [
                'month' => $month,
                'frequency' => round($frequency, 2), // Làm tròn 2 chữ số thập phân
            ];
        }

        return response()->json([
            'year' => $year,
            'monthly_purchase_frequency' => $monthlyPurchaseFrequency
        ]);
    }

    public function getTopSpendingCustomers(Request $request)
    {
        // Số lượng khách hàng muốn lấy
        $limit = $request->get('limit', 5); // Mặc định lấy 5 khách hàng chi tiêu cao nhất

        // Loại bộ lọc thời gian (month, quarter, year)
        $filterType = $request->query('filter', 'all'); // all, month, quarter, year

        // Tạo truy vấn cơ bản
        $query = User::withCount(['orders']) // Đếm số đơn hàng
            ->withSum([
                'orders as total_spent' => function ($query) use ($filterType) {
                    // Lọc thời gian theo bộ lọc
                    if ($filterType === 'month') {
                        $query->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year);
                    } elseif ($filterType === 'quarter') {
                        $query->whereRaw('QUARTER(created_at) = ?', [ceil(now()->month / 3)])
                            ->whereYear('created_at', now()->year);
                    } elseif ($filterType === 'year') {
                        $query->whereYear('created_at', now()->year);
                    }
                }
            ], 'total_price')  // Tổng chi tiêu từ các đơn hàng
            ->where('role', 'user') // Chỉ lấy người dùng có vai trò user
            ->having('total_spent', '>', 0)
            ->orderByDesc('total_spent')  // Sắp xếp theo tổng chi tiêu giảm dần
            ->limit($limit);  // Giới hạn số lượng khách hàng lấy

        // Lấy danh sách khách hàng
        $topSpendingCustomers = $query->get();

        // Trả về kết quả
        return response()->json([
            'filter' => $filterType,
            'customers' => $topSpendingCustomers
        ]);
    }


}
