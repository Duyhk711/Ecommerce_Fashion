<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerStatisticController extends Controller
{
    public function getPotentialCustomers(Request $request)
    {
        // Lấy tham số lọc thời gian
        $filterType = $request->input('filter', 'all'); // Giá trị: day, week, month, year, all
        $startDate = $request->input('start_date'); // Lọc theo khoảng thời gian
        $endDate = $request->input('end_date');

        // Xây dựng truy vấn thời gian
        $query = DB::table('users')
            ->select('users.id', 'users.name', 'users.email', 'users.phone');

        // Lọc theo loại thời gian
        if ($filterType !== 'all') {
            switch ($filterType) {
                case 'day':
                    $query->whereDate('users.created_at', '=', now()->format('Y-m-d'));
                    break;
                case 'week':
                    $query->whereBetween('users.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereYear('users.created_at', '=', now()->year)
                        ->whereMonth('users.created_at', '=', now()->month);
                    break;
                case 'year':
                    $query->whereYear('users.created_at', '=', now()->year);
                    break;
            }
        }

        // Lọc theo khoảng ngày cụ thể
        if ($startDate && $endDate) {
            $query->whereBetween('users.created_at', [$startDate, $endDate]);
        }

        // Thống kê từng loại khách hàng
        $potentialCustomers = (clone $query)
            ->join('carts', 'users.id', '=', 'carts.user_id')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->leftJoin('orders', function ($join) {
                $join->on('users.id', '=', 'orders.user_id')
                    ->whereNull('orders.deleted_at');
            })
            ->whereNull('orders.id')
            ->groupBy('users.id', 'users.name', 'users.email', 'users.phone')
            ->get();

        $registeredCustomers = (clone $query)
            ->leftJoin('orders', function ($join) {
                $join->on('users.id', '=', 'orders.user_id')
                    ->whereNull('orders.deleted_at');
            })
            ->whereNull('orders.id')
            ->where('users.is_active', 1)
            ->get();

        $successfulCustomers = (clone $query)
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('orders.status', '4')
            ->groupBy('users.id', 'users.name', 'users.email', 'users.phone')
            ->get();

        return response()->json([
            'filter_type' => $filterType,
            'potential_customers' => $potentialCustomers,
            'registered_customers' => $registeredCustomers,
            'successful_customers' => $successfulCustomers,
        ]);
    }
    /**
     * Tính toán tỷ lệ khách hàng quay lại
     */
    public function getReturningCustomerRate(Request $request)
    {
        // Lấy tham số lọc từ request
        $filterType = $request->query('filter', 'all'); // all, month, quarter, year
        $filterValue = $request->query('value'); // Giá trị tương ứng (nếu có)

        // Query lấy khách hàng có ít nhất 1 giao dịch thành công
        $query = DB::table('orders')
        ->select('user_id', DB::raw('MIN(created_at) as first_order_date'))
        ->where('status', '3') // 3: Thành công
            ->groupBy('user_id');

        // Áp dụng bộ lọc
        if ($filterType === 'month' && $filterValue) {
            $query->whereMonth('created_at', $filterValue)
                ->whereYear('created_at', now()->year);
        } elseif ($filterType === 'quarter' && $filterValue) {
            $query->whereRaw('QUARTER(created_at) = ?', [$filterValue])
                ->whereYear('created_at', now()->year);
        } elseif ($filterType === 'year' && $filterValue) {
            $query->whereYear('created_at', $filterValue);
        }

        // Danh sách khách hàng có ít nhất 1 giao dịch thành công
        $successfulCustomers = $query->pluck('user_id')->toArray();

        // Tính tổng số khách hàng có ít nhất 1 giao dịch thành công
        $totalSuccessfulCustomers = count($successfulCustomers);

        // Lấy danh sách khách hàng quay lại
        $returningCustomers = DB::table('orders')
        ->whereIn('user_id', $successfulCustomers)
            ->where('status', '3')
            ->whereRaw('DATEDIFF(created_at, (SELECT MIN(o2.created_at) FROM orders o2 WHERE o2.user_id = orders.user_id AND o2.status = "3")) >= 30')
            ->distinct()
            ->pluck('user_id')
            ->toArray();

        // Tính tổng số khách hàng quay lại
        $totalReturningCustomers = count($returningCustomers);

        // Tính tỷ lệ khách hàng quay lại
        $returnRate = $totalSuccessfulCustomers > 0
            ? ($totalReturningCustomers / $totalSuccessfulCustomers) * 100
            : 0;

        return response()->json([
            'filter' => $filterType,
            'value' => $filterValue,
            'total_successful_customers' => $totalSuccessfulCustomers,
            'total_returning_customers' => $totalReturningCustomers,
            'return_rate' => round($returnRate, 2) // Làm tròn 2 chữ số thập phân
        ]);
    }
    /**
     * API Tần suất mua hàng
     */
    public function getPurchaseFrequency(Request $request)
    {
        // Lấy tham số lọc từ request
        $filterType = $request->query('filter', 'all'); // all, month, quarter, year
        $filterValue = $request->query('value'); // Giá trị tương ứng (nếu có)

        // Khởi tạo query cơ bản
        $query = DB::table('orders')
        ->select(DB::raw('COUNT(*) as total_orders, COUNT(DISTINCT user_id) as total_customers'))
        ->where('status', '3'); // 3: Thành công

        // Áp dụng bộ lọc
        if ($filterType === 'month' && $filterValue) {
            $query->whereMonth('created_at', $filterValue)
                ->whereYear('created_at', now()->year);
        } elseif ($filterType === 'quarter' && $filterValue) {
            $query->whereRaw('QUARTER(created_at) = ?', [$filterValue])
                ->whereYear('created_at', now()->year);
        } elseif ($filterType === 'year' && $filterValue) {
            $query->whereYear('created_at', $filterValue);
        }

        // Lấy kết quả
        $result = $query->first();

        // Tính tần suất mua hàng
        $purchaseFrequency = $result->total_customers > 0
            ? $result->total_orders / $result->total_customers
            : 0;

        return response()->json([
            'filter' => $filterType,
            'value' => $filterValue,
            'total_orders' => $result->total_orders,
            'total_customers' => $result->total_customers,
            'purchase_frequency' => round($purchaseFrequency, 2) // Làm tròn 2 chữ số thập phân
        ]);
    }
}
