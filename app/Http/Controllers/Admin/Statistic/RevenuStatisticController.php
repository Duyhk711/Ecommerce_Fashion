<?php

namespace App\Http\Controllers\Admin\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RevenuStatisticController extends Controller
{
    public function getCategoryRevenue()
    {
        // Lấy tất cả các đơn hàng đã thanh toán (status 'da_thanh_toan')
        $orders = Order::where('payment_status', 'da_thanh_toan')->get();

        // Mảng chứa tổng doanh thu theo từng danh mục
        $categoryRevenue = [];

        // Duyệt qua tất cả các đơn hàng
        foreach ($orders as $order) {
            // Lấy tất cả các sản phẩm trong đơn hàng
            $orderItems = OrderItem::where('order_id', $order->id)->get();

            foreach ($orderItems as $item) {
                // Lấy thông tin product_variant
                $productVariant = ProductVariant::find($item->product_variant_id);

                if ($productVariant) {
                    // Lấy thông tin sản phẩm
                    $product = Product::find($productVariant->product_id);

                    if ($product) {
                        // Lấy thông tin danh mục
                        $category = Catalogue::find($product->catalogue_id);

                        if ($category) {
                            // Nếu danh mục chưa có trong mảng doanh thu, tạo mới
                            if (!isset($categoryRevenue[$category->name])) {
                                $categoryRevenue[$category->name] = 0;
                            }

                            // Cộng doanh thu cho danh mục
                            $categoryRevenue[$category->name] += ($item->quantity * $item->variant_price_sale) * 1000;
                        }
                    }
                }
            }
        }

        // Trả dữ liệu về dưới dạng JSON
        return response()->json($categoryRevenue);
    }

    public function getCategoryDetails()
    {
        try {
            // Lấy tất cả các đơn hàng đã thanh toán
            $orders = Order::where('payment_status', 'da_thanh_toan')->get();

            $categoryDetails = [];

            foreach ($orders as $order) {
                // Lấy danh sách sản phẩm trong từng đơn hàng
                $orderItems = OrderItem::where('order_id', $order->id)->get();

                foreach ($orderItems as $item) {
                    // Kiểm tra product_variant_id có hợp lệ
                    if (!$item->product_variant_id) {
                        continue;
                    }

                    // Lấy thông tin product_variant
                    $productVariant = ProductVariant::find($item->product_variant_id);
                    if (!$productVariant || !$productVariant->product_id) {
                        continue;
                    }

                    // Tìm sản phẩm gốc
                    $product = Product::find($productVariant->product_id);
                    if (!$product || !$product->catalogue_id) {
                        continue;
                    }

                    // Tìm danh mục
                    $category = Catalogue::find($product->catalogue_id);
                    if (!$category) {
                        continue;
                    }

                    $categoryName = $category->name;

                    // Nếu danh mục chưa có trong mảng, khởi tạo
                    if (!isset($categoryDetails[$categoryName])) {
                        $categoryDetails[$categoryName] = [
                            'quantity_sold' => 0,
                            'revenue' => 0
                        ];
                    }

                    // Tăng số lượng bán và doanh thu
                    $categoryDetails[$categoryName]['quantity_sold'] += $item->quantity;
                    $categoryDetails[$categoryName]['revenue'] += $item->quantity * 1000 * ($item->variant_price_sale ?? $item->variant_price_regular);
                }
            }

            // Chuyển dữ liệu sang dạng danh sách cho bảng
            $categoryDetailsList = [];
            foreach ($categoryDetails as $categoryName => $details) {
                $categoryDetailsList[] = [
                    'name' => $categoryName,
                    'quantity_sold' => $details['quantity_sold'],
                    'revenue' => $details['revenue']
                ];
            }

            // Trả về JSON
            return response()->json($categoryDetailsList, 200);
        } catch (\Exception $e) {
            // Ghi log lỗi chi tiết
            Log::error('Error in getCategoryDetails:', ['exception' => $e]);

            return response()->json(['error' => 'Có lỗi xảy ra khi lấy dữ liệu danh mục'], 500);
        }
    }

    // pie chart
    public function getRevenueByPaymentMethod()
    {
        try {
            // Lấy dữ liệu doanh thu theo phương thức thanh toán
            $revenueByPaymentMethod = DB::table('orders')
                ->select('payment_method', DB::raw('SUM(total_price * 1000) as total_revenue'))
                ->where('payment_status', 'da_thanh_toan') // Chỉ lấy đơn đã thanh toán
                ->groupBy('payment_method')
                ->get();

            // Chuẩn bị dữ liệu trả về
            $data = $revenueByPaymentMethod->mapWithKeys(function ($item) {
                return [
                    $item->payment_method => $item->total_revenue
                ];
            });

            return response()->json($data, 200);
        } catch (\Exception $e) {
            Log::error('Error in getRevenueByPaymentMethod:', ['exception' => $e]);
            return response()->json(['error' => 'Có lỗi xảy ra khi lấy dữ liệu doanh thu'], 500);
        }
    }

    // bieu do line
    public function getMonthlyRevenueByPaymentMethod()
    {
        try {
            // Lấy dữ liệu doanh thu theo tháng và phương thức thanh toán
            $monthlyRevenue = DB::table('orders')
                ->select(DB::raw('MONTH(created_at) as month'), 'payment_method', DB::raw('SUM(total_price * 1000) as total_revenue '))
                ->where('payment_status', 'da_thanh_toan') // Chỉ lấy đơn đã thanh toán
                ->groupBy(DB::raw('MONTH(created_at)'), 'payment_method')
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get();

            // Chia dữ liệu thành các phương thức thanh toán khác nhau (online và COD)
            $onlineRevenue = [];
            $codRevenue = [];
            foreach ($monthlyRevenue as $item) {
                $month = $item->month;
                if ($item->payment_method == 'THANH_TOAN_ONLINE') {
                    $onlineRevenue[$month] = $item->total_revenue;
                } elseif ($item->payment_method == 'COD') {
                    $codRevenue[$month] = $item->total_revenue;
                }
            }

            // Đảm bảo rằng tất cả các tháng đều có dữ liệu
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $data['THANH_TOAN_ONLINE'][] = isset($onlineRevenue[$i]) ? $onlineRevenue[$i] : 0;
                $data['COD'][] = isset($codRevenue[$i]) ? $codRevenue[$i] : 0;
            }

            return response()->json($data, 200);
        } catch (\Exception $e) {
            Log::error('Error in getMonthlyRevenueByPaymentMethod:', ['exception' => $e]);
            return response()->json(['error' => 'Có lỗi xảy ra khi lấy dữ liệu doanh thu'], 500);
        }
    }
}
