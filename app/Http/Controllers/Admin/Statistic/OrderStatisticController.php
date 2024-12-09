<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderStatisticController extends Controller
{
    public function getOrderStatistics(Request $request)
    {
        $startDate = null;
        $endDate = null;

        // Lọc theo thời gian
        if ($request->has('filter')) {
            $filter = $request->input('filter');
            switch ($filter) {
                case 'this_year':
                    $startDate = Carbon::now()->startOfYear();
                    $endDate = Carbon::now()->endOfYear();
                    break;
                case 'this_month':
                    $startDate = Carbon::now()->startOfMonth();
                    $endDate = Carbon::now()->endOfMonth();
                    break;
                case 'all_time':
                    $startDate = Carbon::createFromDate(2000, 1, 1);  // Hoặc bạn có thể thay đổi cho phù hợp
                    $endDate = Carbon::now();
                    break;
                default:
                    $startDate = Carbon::createFromDate(2000, 1, 1);
                    $endDate = Carbon::now();
                    break;
            }
        }

        // Tổng số đơn hàng
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])->count();

        // Tổng doanh thu (tính từ các đơn hàng đã hoàn thành)
        $totalRevenue = Order::where('status', '4')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_price')*1000;

        return response()->json([
            'total_orders' => $totalOrders,
            'total_revenue' => $totalRevenue,
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
    // don hang gia tri cao
    public function getTopOrders(Request $request)
    {
        try {
            $filter = $request->input('filter', 'all_time');
            $query = Order::select('id', 'sku', 'customer_name', 'total_price', 'created_at');

            // Áp dụng bộ lọc dựa trên yêu cầu
            switch ($filter) {
                case 'last_week':
                    $query->whereBetween('created_at', [
                        now()->startOfWeek()->subWeek(),
                        now()->startOfWeek()->subDay(),
                    ]);
                    break;

                case 'last_month':
                    $query->whereMonth('created_at', now()->subMonth()->month)
                        ->whereYear('created_at', now()->year);
                    break;

                case 'this_year':
                    $query->whereYear('created_at', now()->year);
                    break;

                default:
                    break;
            }

            $topOrders = $query->orderBy('total_price', 'desc')
                ->limit(10)
                ->get();

            $topOrders = $topOrders->map(function ($order) {
                $order->total_price = $order->total_price * 1000;
                return $order;
            });

            return response()->json($topOrders, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }



    // sanpham da ban ra
    public function getProductStatistics()
    {
        try {
            // Tổng số sản phẩm (tính từ bảng products hoặc variants)
            $totalProducts = ProductVariant::sum('stock');

            // Số lượng sản phẩm đã bán ra (tính từ bảng order_items)
            $totalSoldProducts = OrderItem::sum('quantity'); // Chú ý fix tên cột nếu cần

            // Trả về dữ liệu dạng JSON
            return response()->json([
                'total_products' => $totalProducts,
                'sold_products' => $totalSoldProducts,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }

    // bieu do san pham da ban
    public function getMonthlySalesData()
    {
        try {
            $salesData = DB::table('order_items')
                ->select(
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('SUM(quantity) as total_sales')
                )
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get();

            return response()->json($salesData, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Đã xảy ra lỗi: ' . $e->getMessage(),
            ], 500);
        }
    }

    // dơn han va san pham 
    public function getMonthlyOrderAndProductStats()
    {
        $data = DB::table('orders as o')
            ->leftJoin('order_items as oi', 'o.id', '=', 'oi.order_id')
            ->selectRaw('MONTH(o.created_at) as month')
            ->selectRaw('COUNT(DISTINCT o.id) as total_orders')
            ->selectRaw('SUM(oi.quantity) as total_products')
            ->whereYear('o.created_at', now()->year)
            ->groupByRaw('MONTH(o.created_at)')
            ->orderByRaw('MONTH(o.created_at)')
            ->get();

        // Đảm bảo dữ liệu đủ 12 tháng (nếu không có đơn hàng/tháng thì sẽ là 0)
        $monthlyData = array_fill(1, 12, ['orders' => 0, 'products' => 0]);

        foreach ($data as $item) {
            $monthlyData[$item->month] = [
                'orders' => $item->total_orders,
                'products' => $item->total_products,
            ];
        }

        return response()->json($monthlyData, 200);
    }
}
