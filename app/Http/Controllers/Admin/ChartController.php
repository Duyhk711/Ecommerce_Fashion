<?php

namespace App\Http\Controllers\Admin;

use Log;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    //TOng doanh thu
    public function getMonthlyRevenue($year)
    {
        $monthlyRevenue = DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) * 1000 as total_revenue'))
            ->whereYear('created_at', $year)
            // Loại bỏ điều kiện status để tính cả đơn hàng đã hủy
            ->where('status', '=', '4')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        return response()->json($monthlyRevenue);
    }

    public function getDailyRevenue($year, $month)
    {
        $dailyRevenue = DB::table('orders')
            ->select(DB::raw('DAY(created_at) as day'), DB::raw('SUM(total_price) * 1000 as total_revenue'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            // Loại bỏ điều kiện status để tính cả đơn hàng đã hủy
            ->where('status', '=', '4')
            ->groupBy(DB::raw('DAY(created_at)'))
            ->orderBy(DB::raw('DAY(created_at)'))
            ->get();

        return response()->json($dailyRevenue);
    }

    public function getRevenueByDateRange($startDate, $endDate)
    {
        // Chuyển đổi ngày bắt đầu và kết thúc sang định dạng phù hợp với DB
        $dailyRevenue = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) * 1000 as total_revenue'))
            ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
            // Loại bỏ điều kiện status để tính cả đơn hàng đã hủy
            ->where('status', '=', '4')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'))
            ->get();

        return response()->json($dailyRevenue);
    }

    public function getTotalIncome()
    {
        try {
            $totalIncome = DB::table('orders')
                ->where('status', '4')
                ->sum('total_price') * 1000;

            if (is_null($totalIncome)) {
                $totalIncome = 0;
            }

            return response()->json([
                'total_income' => $totalIncome,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch total income',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getTotalOrders()
    {
        $totalOrders = DB::table('orders')->count();

        return response()->json([
            'total_orders' => $totalOrders ?? 0,
        ]);
    }

    public function getTotalCustomers()
    {
        try {
            // Đếm tổng số khách hàng (role = 'user')
            $totalCustomers = DB::table('users')
                ->where('role', 'user')
                ->count();

            return response()->json([
                'total_customers' => $totalCustomers,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch total customers',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getTotalSoldProducts()
    {
        try {
            // Truy vấn tổng số lượng sản phẩm đã bán
            $totalSold = DB::table('orders as o')
                ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
                ->where('o.status', '!=', 'huy_don_hang')
                ->sum('oi.quantity');

            // Trả kết quả JSON
            return response()->json([
                'total_sold_products' => $totalSold,
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return response()->json([
                'error' => 'Failed to fetch total sold products',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getOrders(Request $request)
    {
        // Lọc các đơn hàng mới nhất, kèm theo thông tin các sản phẩm trong đơn hàng
        $orders = Order::with('items')  // Lấy thông tin các OrderItem liên quan
            ->orderBy('created_at', 'desc') // Sắp xếp theo ngày tạo, từ mới nhất
            ->take(5) // Chỉ lấy 5 đơn hàng mới nhất
            ->get();

        // Trả về dữ liệu dưới dạng JSON
        return response()->json([
            'data' => $orders
        ]);
    }

    public function getOrderStatusDistribution()
    {
        $statuses = [
            '1' => 'Chờ xác nhận',
            '2' => 'Chờ vận chuyển',
            '3' => 'Đã vận chuyển',
            '4' => 'Hoàn thành',
            'huy_don_hang' => 'Đã hủy',
        ];

        $data = DB::table('orders')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        $totalOrders = $data->sum('count');
        $distribution = $data->map(function ($item) use ($statuses, $totalOrders) {
            return [
                'status' => $statuses[$item->status],
                'count' => $item->count,
                'percentage' => round(($item->count / $totalOrders) * 100, 2),
            ];
        });

        return response()->json($distribution);
    }

    public function getSalesStatistics(Request $request)
    {
        // Lấy bộ lọc từ request, mặc định là 'today'
        $filter = $request->query('filter', 'today');

        // Xác định khoảng thời gian dựa trên bộ lọc
        $now = Carbon::now();

        switch ($filter) {
            case 'today':
                $startDate = $now->clone()->startOfDay();
                $endDate = $now->clone()->endOfDay();
                break;
            case 'last_7_days':
                $startDate = $now->clone()->subDays(6)->startOfDay(); // Bao gồm ngày hiện tại
                $endDate = $now->clone()->endOfDay();
                break;
            case 'last_30_days':
                $startDate = $now->clone()->subDays(29)->startOfDay(); // Bao gồm ngày hiện tại
                $endDate = $now->clone()->endOfDay();
                break;
            case 'this_month':
                $startDate = $now->clone()->startOfMonth();
                $endDate = $now->clone()->endOfMonth();
                break;
            case 'last_month':
                $startDate = $now->clone()->subMonth()->startOfMonth();
                $endDate = $now->clone()->subMonth()->endOfMonth();
                break;
            default:
                return response()->json(['error' => 'Invalid filter'], 400);
        }

        // Truy vấn thống kê
        $query = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('product_variants', 'order_items.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->select(
                'products.name',
                'products.img_thumbnail',
                'products.price_regular',
                'products.price_sale',
                DB::raw('SUM(order_items.quantity) as total_quantity_sold'),
                DB::raw('SUM(order_items.quantity * CASE
                    WHEN product_variants.price_sale IS NOT NULL AND product_variants.price_sale > 0 THEN product_variants.price_sale
                    ELSE product_variants.price_regular
                    END) as total_revenue')
                )
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity_sold')
            ->limit(5)
            ->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json($query, 200);
    }

    public function topRatedProducts(Request $request)
    {
        $filter = $request->query('filter', 'today'); // Mặc định là 'today'
        $now = Carbon::now();

        // Xác định khoảng thời gian dựa trên bộ lọc
        switch ($filter) {
            case 'today':
                $startDate = $now->clone()->startOfDay();
                $endDate = $now->clone()->endOfDay();
                break;
            case 'last_7_days':
                $startDate = $now->clone()->subDays(6)->startOfDay();
                $endDate = $now->clone()->endOfDay();
                break;
            case 'last_30_days':
                $startDate = $now->clone()->subDays(29)->startOfDay();
                $endDate = $now->clone()->endOfDay();
                break;
            case 'this_month':
                $startDate = $now->clone()->startOfMonth();
                $endDate = $now->clone()->endOfMonth();
                break;
            case 'last_month':
                $startDate = $now->clone()->subMonth()->startOfMonth();
                $endDate = $now->clone()->subMonth()->endOfMonth();
                break;
            default:
                $startDate = $request->query('start_date') ? Carbon::parse($request->query('start_date'))->startOfDay() : null;
                $endDate = $request->query('end_date') ? Carbon::parse($request->query('end_date'))->endOfDay() : null;

                if (!$startDate || !$endDate) {
                    return response()->json(['error' => 'Invalid filter or missing date range'], 400);
                }
                break;
        }

        // Truy vấn dữ liệu bằng Query Builder
        $topProducts = DB::table('products')
            ->select('products.*')
            ->selectRaw('COALESCE(COUNT(comments.id), 0) as total_comments')
            ->selectRaw('COALESCE(AVG(comments.rating), 0) as average_rating')
            ->leftJoin('comments', 'comments.product_id', '=', 'products.id')
            ->whereBetween('comments.created_at', [$startDate, $endDate])
            ->groupBy('products.id')
            ->orderByDesc('total_comments')
            ->orderByDesc('average_rating')
            ->limit(5)
            ->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json([
            'success' => true,
            'data' => $topProducts,
        ]);
    }

}
