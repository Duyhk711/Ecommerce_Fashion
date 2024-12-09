<?php

namespace App\Http\Controllers\Admin;

use Log;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Catalogue;
use App\Models\OrderItem;
use App\Models\UserVoucher;
use App\Models\Voucher;

class ChartController extends Controller
{
    //TOng doanh thu
    //     public function getMonthlyRevenue($year)
    //     {
    //         $monthlyRevenue = DB::table('orders')
    //             ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) * 1000 as total_revenue'))
    //             ->whereYear('created_at', $year)
    //             // Loại bỏ điều kiện status để tính cả đơn hàng đã hủy
    //             ->where('status', '=', '4')
    //             ->groupBy(DB::raw('MONTH(created_at)'))
    //             ->orderBy(DB::raw('MONTH(created_at)'))
    //             ->get();

    //         return response()->json($monthlyRevenue);
    //     }

    //     public function getDailyRevenue($year, $month)
    //     {
    //         $dailyRevenue = DB::table('orders')
    //             ->select(DB::raw('DAY(created_at) as day'), DB::raw('SUM(total_price) * 1000 as total_revenue'))
    //             ->whereYear('created_at', $year)
    //             ->whereMonth('created_at', $month)
    //             // Loại bỏ điều kiện status để tính cả đơn hàng đã hủy
    //             ->where('status', '=', '4')
    //             ->groupBy(DB::raw('DAY(created_at)'))
    //             ->orderBy(DB::raw('DAY(created_at)'))
    //             ->get();

    //         return response()->json($dailyRevenue);
    //     }

    //     public function getRevenueByDateRange($startDate, $endDate)
    //     {
    //         // Chuyển đổi ngày bắt đầu và kết thúc sang định dạng phù hợp với DB
    //         $dailyRevenue = DB::table('orders')
    //             ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) * 1000 as total_revenue'))
    //             ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
    //             // Loại bỏ điều kiện status để tính cả đơn hàng đã hủy
    //             ->where('status', '=', '4')
    //             ->groupBy(DB::raw('DATE(created_at)'))
    //             ->orderBy(DB::raw('DATE(created_at)'))
    //             ->get();

    //         return response()->json($dailyRevenue);
    //     }

    //     public function getTotalIncomeByWeek()
    // {
    //     try {
    //         // Lấy ngày bắt đầu và kết thúc của tuần hiện tại
    //         $startOfWeek = today()->startOfWeek(); // Thứ Hai
    //         $endOfWeek = today()->endOfDay(); // Hôm nay

    //         // Lấy ngày bắt đầu và kết thúc của tuần trước
    //         $startOfLastWeek = today()->subWeek()->startOfWeek(); // Thứ Hai tuần trước
    //         $endOfLastWeek = today()->subWeek()->endOfWeek(); // Chủ Nhật tuần trước

    //         // Tổng thu nhập tuần hiện tại (tới hôm nay)
    //         $totalIncomeThisWeek = DB::table('orders')
    //             ->where('status', '4') // Chỉ tính những đơn hàng hoàn thành
    //             ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    //             ->sum('total_price') * 1000;

    //         // Lấy các ngày có dữ liệu trong tuần trước
    //         $daysWithDataLastWeek = DB::table('orders')
    //             ->selectRaw('DATE(created_at) as date')
    //             ->where('status', '4')
    //             ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
    //             ->groupBy(DB::raw('DATE(created_at)'))
    //             ->pluck('date'); // Lấy danh sách ngày có dữ liệu

    //         // Tổng thu nhập tuần trước chỉ tính cho các ngày có dữ liệu
    //         $totalIncomeLastWeek = DB::table('orders')
    //             ->where('status', '4')
    //             ->whereIn(DB::raw('DATE(created_at)'), $daysWithDataLastWeek)
    //             ->sum('total_price') * 1000;

    //         // Đảm bảo không bị null
    //         $totalIncomeThisWeek = $totalIncomeThisWeek ?: 0;
    //         $totalIncomeLastWeek = $totalIncomeLastWeek ?: 0;

    //         // Tính phần trăm thay đổi
    //         $percentChange = $totalIncomeLastWeek > 0
    //             ? (($totalIncomeThisWeek - $totalIncomeLastWeek) / $totalIncomeLastWeek) * 100
    //             : ($totalIncomeThisWeek > 0 ? 100 : 0);

    //         return response()->json([
    //             'total_income_this_week' => $totalIncomeThisWeek,
    //             'total_income_last_week' => $totalIncomeLastWeek,
    //             'percent_change' => $percentChange,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Failed to fetch total income',
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }




    // // togn don hang trong ngay
    // public function getTotalOrdersByWeek()
    // {
    //     try {
    //         // Ngày bắt đầu và kết thúc của tuần hiện tại
    //         $startOfWeek = today()->startOfWeek(); // Thứ Hai tuần này
    //         $endOfWeek = today()->endOfWeek(); // Chủ Nhật tuần này

    //         // Ngày bắt đầu và kết thúc của tuần trước
    //         $startOfLastWeek = today()->subWeek()->startOfWeek(); // Thứ Hai tuần trước
    //         $endOfLastWeek = today()->subWeek()->endOfWeek(); // Chủ Nhật tuần trước

    //         // Tổng đơn hàng tuần này
    //         $totalOrdersThisWeek = DB::table('orders')
    //             ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    //             ->count();

    //         // Tổng đơn hàng tuần trước
    //         $totalOrdersLastWeek = DB::table('orders')
    //             ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
    //             ->count();

    //         // Tính phần trăm thay đổi
    //         $percentChange = $totalOrdersLastWeek > 0
    //             ? (($totalOrdersThisWeek - $totalOrdersLastWeek) / $totalOrdersLastWeek) * 100
    //             : ($totalOrdersThisWeek > 0 ? 100 : 0);

    //         return response()->json([
    //             'total_orders_this_week' => $totalOrdersThisWeek,
    //             'total_orders_last_week' => $totalOrdersLastWeek,
    //             'percent_change' => $percentChange,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Failed to fetch order data',
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }



    // public function getTotalCustomersByWeek()
    // {
    //     try {
    //         // Ngày bắt đầu và kết thúc của tuần hiện tại
    //         $startOfWeek = today()->startOfWeek(); // Thứ Hai tuần này
    //         $endOfWeek = today()->endOfWeek(); // Chủ Nhật tuần này

    //         // Ngày bắt đầu và kết thúc của tuần trước
    //         $startOfLastWeek = today()->subWeek()->startOfWeek(); // Thứ Hai tuần trước
    //         $endOfLastWeek = today()->subWeek()->endOfWeek(); // Chủ Nhật tuần trước

    //         // Tổng số khách hàng mới trong tuần này
    //         $totalCustomersThisWeek = DB::table('users')
    //             ->where('role', 'user')
    //             ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    //             ->count();

    //         // Tổng số khách hàng mới trong tuần trước
    //         $totalCustomersLastWeek = DB::table('users')
    //             ->where('role', 'user')
    //             ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
    //             ->count();

    //         // Tính phần trăm thay đổi
    //         $percentChange = $totalCustomersLastWeek > 0
    //             ? (($totalCustomersThisWeek - $totalCustomersLastWeek) / $totalCustomersLastWeek) * 100
    //             : ($totalCustomersThisWeek > 0 ? 100 : 0); // Nếu tuần trước không có khách hàng, tăng 100%.

    //         return response()->json([
    //             'total_customers_this_week' => $totalCustomersThisWeek,
    //             'total_customers_last_week' => $totalCustomersLastWeek,
    //             'percent_change' => $percentChange,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Failed to fetch total customers',
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }



    // public function getTotalSoldProductsByWeek()
    // {
    //     try {
    //         // Ngày bắt đầu và kết thúc của tuần hiện tại
    //         $startOfWeek = today()->startOfWeek(); // Thứ Hai tuần này
    //         $endOfWeek = today()->endOfWeek(); // Chủ Nhật tuần này

    //         // Ngày bắt đầu và kết thúc của tuần trước
    //         $startOfLastWeek = today()->subWeek()->startOfWeek(); // Thứ Hai tuần trước
    //         $endOfLastWeek = today()->subWeek()->endOfWeek(); // Chủ Nhật tuần trước

    //         // Tổng số sản phẩm đã bán trong tuần này
    //         $totalSoldThisWeek = DB::table('orders as o')
    //             ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
    //             ->where('o.status', '!=', 'huy_don_hang')
    //             ->whereBetween('o.created_at', [$startOfWeek, $endOfWeek])
    //             ->sum('oi.quantity');

    //         // Tổng số sản phẩm đã bán trong tuần trước
    //         $totalSoldLastWeek = DB::table('orders as o')
    //             ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
    //             ->where('o.status', '!=', 'huy_don_hang')
    //             ->whereBetween('o.created_at', [$startOfLastWeek, $endOfLastWeek])
    //             ->sum('oi.quantity');

    //         // Tính phần trăm thay đổi
    //         $percentChange = $totalSoldLastWeek > 0
    //             ? (($totalSoldThisWeek - $totalSoldLastWeek) / $totalSoldLastWeek) * 100
    //             : ($totalSoldThisWeek > 0 ? 100 : 0); // Nếu tuần trước không có sản phẩm bán, tăng 100%.

    //         return response()->json([
    //             'total_sold_this_week' => $totalSoldThisWeek,
    //             'total_sold_last_week' => $totalSoldLastWeek,
    //             'percent_change' => round($percentChange, 2),
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Failed to fetch total sold products',
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }


    //     public function getOrders(Request $request)
    //     {
    //         // Lọc các đơn hàng mới nhất, kèm theo thông tin các sản phẩm trong đơn hàng
    //         $orders = Order::with('items')  // Lấy thông tin các OrderItem liên quan
    //             ->orderBy('created_at', 'desc') // Sắp xếp theo ngày tạo, từ mới nhất
    //             ->take(5) // Chỉ lấy 5 đơn hàng mới nhất
    //             ->get();

    //         // Trả về dữ liệu dưới dạng JSON
    //         return response()->json([
    //             'data' => $orders
    //         ]);
    //     }

    //     public function getOrderStatusDistribution()
    //     {
    //         $statuses = [
    //             '1' => 'Chờ xác nhận',
    //             '2' => 'Chờ vận chuyển',
    //             '3' => 'Đã vận chuyển',
    //             '4' => 'Hoàn thành',
    //             'huy_don_hang' => 'Đã hủy',
    //         ];

    //         $data = DB::table('orders')
    //             ->select('status', DB::raw('COUNT(*) as count'))
    //             ->groupBy('status')
    //             ->get();

    //         $totalOrders = $data->sum('count');
    //         $distribution = $data->map(function ($item) use ($statuses, $totalOrders) {
    //             return [
    //                 'status' => $statuses[$item->status],
    //                 'count' => $item->count,
    //                 'percentage' => round(($item->count / $totalOrders) * 100, 2),
    //             ];
    //         });

    //         return response()->json($distribution);
    //     }

    //     public function getSalesStatistics(Request $request)
    //     {
    //         // Lấy bộ lọc từ request, mặc định là 'today'
    //         $filter = $request->query('filter', 'today');

    //         // Xác định khoảng thời gian dựa trên bộ lọc
    //         $now = Carbon::now();

    //         switch ($filter) {
    //             case 'today':
    //                 $startDate = $now->clone()->startOfDay();
    //                 $endDate = $now->clone()->endOfDay();
    //                 break;
    //             case 'last_7_days':
    //                 $startDate = $now->clone()->subDays(6)->startOfDay(); // Bao gồm ngày hiện tại
    //                 $endDate = $now->clone()->endOfDay();
    //                 break;
    //             case 'last_30_days':
    //                 $startDate = $now->clone()->subDays(29)->startOfDay(); // Bao gồm ngày hiện tại
    //                 $endDate = $now->clone()->endOfDay();
    //                 break;
    //             case 'this_month':
    //                 $startDate = $now->clone()->startOfMonth();
    //                 $endDate = $now->clone()->endOfMonth();
    //                 break;
    //             case 'last_month':
    //                 $startDate = $now->clone()->subMonth()->startOfMonth();
    //                 $endDate = $now->clone()->subMonth()->endOfMonth();
    //                 break;
    //             default:
    //                 return response()->json(['error' => 'Invalid filter'], 400);
    //         }

    //         // Truy vấn thống kê
    //         $query = DB::table('order_items')
    //             ->join('orders', 'order_items.order_id', '=', 'orders.id')
    //             ->join('product_variants', 'order_items.product_variant_id', '=', 'product_variants.id')
    //             ->join('products', 'product_variants.product_id', '=', 'products.id')
    //             ->select(
    //                 'products.name',
    //                 'products.img_thumbnail',
    //                 'products.price_regular',
    //                 'products.price_sale',
    //                 DB::raw('SUM(order_items.quantity) as total_quantity_sold'),
    //                 DB::raw('SUM(order_items.quantity * CASE
    //                     WHEN product_variants.price_sale IS NOT NULL AND product_variants.price_sale > 0 THEN product_variants.price_sale
    //                     ELSE product_variants.price_regular
    //                     END) as total_revenue')
    //                 )
    //             ->whereBetween('orders.created_at', [$startDate, $endDate])
    //             ->groupBy('products.id', 'products.name')
    //             ->orderByDesc('total_quantity_sold')
    //             ->limit(5)
    //             ->get();

    //         // Trả về kết quả dưới dạng JSON
    //         return response()->json($query, 200);
    //     }

    //     public function topRatedProducts(Request $request)
    //     {
    //         $filter = $request->query('filter', 'today'); // Mặc định là 'today'
    //         $now = Carbon::now();

    //         // Xác định khoảng thời gian dựa trên bộ lọc
    //         switch ($filter) {
    //             case 'today':
    //                 $startDate = $now->clone()->startOfDay();
    //                 $endDate = $now->clone()->endOfDay();
    //                 break;
    //             case 'last_7_days':
    //                 $startDate = $now->clone()->subDays(6)->startOfDay();
    //                 $endDate = $now->clone()->endOfDay();
    //                 break;
    //             case 'last_30_days':
    //                 $startDate = $now->clone()->subDays(29)->startOfDay();
    //                 $endDate = $now->clone()->endOfDay();
    //                 break;
    //             case 'this_month':
    //                 $startDate = $now->clone()->startOfMonth();
    //                 $endDate = $now->clone()->endOfMonth();
    //                 break;
    //             case 'last_month':
    //                 $startDate = $now->clone()->subMonth()->startOfMonth();
    //                 $endDate = $now->clone()->subMonth()->endOfMonth();
    //                 break;
    //             default:
    //                 $startDate = $request->query('start_date') ? Carbon::parse($request->query('start_date'))->startOfDay() : null;
    //                 $endDate = $request->query('end_date') ? Carbon::parse($request->query('end_date'))->endOfDay() : null;

    //                 if (!$startDate || !$endDate) {
    //                     return response()->json(['error' => 'Invalid filter or missing date range'], 400);
    //                 }
    //                 break;
    //         }

    //         // Truy vấn dữ liệu bằng Query Builder
    //         $topProducts = DB::table('products')
    //             ->select('products.*')
    //             ->selectRaw('COALESCE(COUNT(comments.id), 0) as total_comments')
    //             ->selectRaw('COALESCE(AVG(comments.rating), 0) as average_rating')
    //             ->leftJoin('comments', 'comments.product_id', '=', 'products.id')
    //             ->whereBetween('comments.created_at', [$startDate, $endDate])
    //             ->groupBy('products.id')
    //             ->orderByDesc('total_comments')
    //             ->orderByDesc('average_rating')
    //             ->limit(5)
    //             ->get();

    //         // Trả về kết quả dưới dạng JSON
    //         return response()->json([
    //             'success' => true,
    //             'data' => $topProducts,
    //         ]);
    //     }

    public function getOrdersOverview()
    {
        // Lấy ngày đầu và cuối của tuần hiện tại
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        // Lấy tổng doanh thu
        $totalRevenue = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', '!=', 'huy_don_hang') // Chỉ tính doanh thu từ đơn hàng không bị hủy
            ->sum('total_price') * 1000;

        // Lấy số lượng đơn hàng theo các trạng thái cụ thể
        $waitingConfirmation = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', '1')
            ->count();

        $delivered = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', '4')
            ->count();

        $cancelled = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where('status', 'huy_don_hang')
            ->count();

        // Dữ liệu biểu đồ: số lượng đơn hàng theo trạng thái và ngày
        $chartData = Order::selectRaw('DATE(created_at) as date, status, COUNT(*) as count')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('date', 'status')
            ->get()
            ->groupBy('date');

        // Trả về dữ liệu JSON
        return response()->json([
            'orders_summary' => [
                'total_revenue' => $totalRevenue,
                'waiting_confirmation' => $waitingConfirmation,
                'delivered' => $delivered,
                'cancelled' => $cancelled,
            ],
            'chart_data' => $chartData,
        ]);
    }

    // 

    // Phương thức lấy doanh thu theo nhóm sản phẩm
    public function productActivity(Request $request)
    {
        // Lọc theo tuần này, tháng này, năm nay
        $period = $request->get('period', 'this_week'); // mặc định là 'this_week'
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        if ($period == 'this_month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($period == 'this_year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        }

        // 1. Lấy danh sách sản phẩm với số lượng bán ra và doanh thu
        $products = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('product_variants', 'order_items.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id') // Lấy thông tin sản phẩm chính
            ->select(
                'products.name as product_name',
                'products.sku as product_sku',
                DB::raw('SUM(order_items.quantity) as sold_quantity'),
                DB::raw('SUM(order_items.quantity * IFNULL(order_items.variant_price_sale, order_items.variant_price_regular)) * 1000 as revenue')
            )
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->whereNull('orders.deleted_at') // Đảm bảo chỉ lấy các đơn hàng chưa bị xóa
            ->groupBy('products.id', 'products.name', 'products.sku') // Nhóm theo sản phẩm
            ->orderByDesc('revenue')
            ->get();

        // 2. Lấy doanh thu theo nhóm sản phẩm (theo danh mục)
        $categories = Catalogue::select(
            'catalogues.name as category_name',
            DB::raw('SUM(order_items.quantity * IFNULL(order_items.variant_price_sale, order_items.variant_price_regular)) * 1000 as category_revenue')
        )
            ->join('products', 'catalogues.id', '=', 'products.catalogue_id')
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('order_items', 'product_variants.id', '=', 'order_items.product_variant_id') // Liên kết với order_items
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->whereNull('orders.deleted_at') // Đảm bảo chỉ lấy các đơn hàng chưa bị xóa
            ->groupBy('catalogues.name')
            ->get();

        // Trả về dữ liệu
        return response()->json([
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function getCustomerStats()
    {
        $currentDate = Carbon::now();
        $oneMonthAgo = $currentDate->copy()->subMonth();

        // 1. Lấy danh sách khách hàng mới
        $newCustomers = DB::table('users')
            ->selectRaw('users.id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('users.role', 'user')
            ->whereNull('users.deleted_at')
            ->where('orders.created_at', '>=', $oneMonthAgo)
            ->groupBy('users.id')
            ->havingRaw('COUNT(orders.id) = 1') // Chỉ có 1 đơn hàng
            ->get();

        // Đếm khách hàng mới
        $newCustomerCount = $newCustomers->count();

        // 2. Lấy danh sách khách hàng cũ
        $returningCustomers = DB::table('users')
            ->selectRaw('users.id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('users.role', 'user')
            ->whereNull('users.deleted_at')
            ->groupBy('users.id')
            ->havingRaw('COUNT(orders.id) >= 2') // Có ít nhất 2 đơn hàng
            ->orWhere('orders.created_at', '<', $oneMonthAgo) // Đơn đầu tiên hơn 1 tháng
            ->distinct()
            ->get();

        // Đếm khách hàng cũ
        $returningCustomerCount = $returningCustomers->count();

        // 3. Tổng số khách hàng
        $totalCustomers = $newCustomerCount + $returningCustomerCount;

        return response()->json([
            'newCustomers' => $newCustomerCount,
            'activeCustomers' => $totalCustomers,
            'chartData' => [
                'new_customers' => $newCustomerCount,
                'returning_customers' => $returningCustomerCount,
            ]
        ]);
    }

    // CART
    public function getCartStats()
    {
        // Lấy số lượng giỏ hàng tạo mới
        $newCartsCount = Cart::whereNull('deleted_at')->count();

        // Lấy tổng giá trị giỏ hàng chưa thanh toán (dựa vào cart_items)
        $totalCartValue = CartItem::join('carts', 'cart_items.cart_id', '=', 'carts.id')
            ->whereNull('carts.deleted_at')  // Giỏ hàng chưa bị xóa
            ->whereNull('cart_items.deleted_at')  // Các item chưa bị xóa
            ->select(DB::raw('SUM(cart_items.price * cart_items.quantity) as total_value'))
            ->value('total_value');

        // Chuyển đổi giá trị thành định dạng tiền tệ (VND)
        $formattedTotalValue =number_format($totalCartValue * 1000 , 0, '.', '.')  ;

        // Trả về dữ liệu dưới dạng JSON
        return response()->json([
            'newCartsCount' => $newCartsCount,
            'totalCartValue' => $formattedTotalValue,
        ]);
    }

    public function getVoucherUsageRate()
    {
        // Lấy tổng số voucher
        $totalVouchers = Voucher::count();

        // Lấy số lượng voucher đã được sử dụng
        $usedVouchers = UserVoucher::distinct('voucher_id')->count('voucher_id');

        // Tính tỷ lệ sử dụng voucher
        $usageRate = $totalVouchers > 0 ? ($usedVouchers / $totalVouchers) * 100 : 0;

        // Trả về kết quả dưới dạng JSON
        return response()->json([
            'total_vouchers' => $totalVouchers,
            'used_vouchers' => $usedVouchers,
            'usage_rate' => number_format($usageRate, 2) . '%'
        ]);
    }
}
