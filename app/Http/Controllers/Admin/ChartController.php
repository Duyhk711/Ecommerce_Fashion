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
            ->where('status', '5')
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
        $formattedTotalValue = number_format($totalCartValue * 1000, 0, '.', '.');

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

    public function commentReport(Request $request)
    {
        // Lọc theo loại thời gian: tuần, tháng, năm
        $type = $request->get('type', 'week'); // Mặc định là tuần
        $startDate = null;
        $endDate = now(); // Ngày hiện tại
    
        // Xác định khoảng thời gian
        switch ($type) {
            case 'week':
                $startDate = now()->startOfWeek();
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                break;
            case 'year':
                $startDate = now()->startOfYear();
                break;
            default:
                return response()->json([
                    'status' => 'error',
                    'message' => 'Loại thời gian không hợp lệ.'
                ], 400);
        }
    
        // Truy vấn tên khách hàng, bình luận, ngày bình luận và đánh giá
        $comments = DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select(
                'users.name as customer_name',
                'comments.comment',
                'comments.created_at as comment_date',
                'comments.rating'
            )
            ->whereBetween('comments.created_at', [$startDate, $endDate])
            ->orderBy('comments.created_at', 'desc') // Sắp xếp theo ngày bình luận giảm dần
            ->get()
            ->map(function ($comment) {
                // Định dạng ngày khi trả về
                $comment->comment_date = \Carbon\Carbon::parse($comment->comment_date)->format('H:i d/m/Y');
                return $comment;
            });
    
        return response()->json([
            'status' => 'success',
            'data' => [
                'comments' => $comments
            ]
        ]);
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
    
}
