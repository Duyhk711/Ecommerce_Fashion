<?php

use App\Http\Controllers\Admin\ChartController;
use App\Http\Controllers\Admin\Statistic\OrderStatisticController;
use App\Http\Controllers\Admin\Statistic\RevenuStatisticController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\AttributeValueController;
// use App\Http\Controllers\Client\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::apiResource('attributes', AttributeController::class);
// Route::apiResource('attribute-values', AttributeValueController::class);
Route::get('/total-income', [ChartController::class, 'getTotalIncomeByWeek'])->name('api.total-income');

Route::get('/total-orders', [ChartController::class, 'getTotalOrdersByWeek'])->name('api.total-orders');
Route::get('/total-customers', [ChartController::class, 'getTotalCustomersByWeek']);
Route::get('/stats/total-sold-products', [ChartController::class, 'getTotalSoldProductsByWeek']);

Route::get('/revenue-data', [ChartController::class, 'getRevenueData']);


Route::get('/orders', [ChartController::class, 'getOrders']);

Route::get('/sales-statistics', [ChartController::class, 'getSalesStatistics']);
Route::get('/products/top-rated', [ChartController::class, 'topRatedProducts']);

Route::get('revenue/monthly/{year}', [StatisticsController::class, 'getMonthlyRevenue']);
Route::get('revenue/daily/{year}/{month}', [StatisticsController::class, 'getDailyRevenue']);
Route::get('/revenue/daily-range/{startDate}/{endDate}', [StatisticsController::class, 'getRevenueByDateRange']);


// statistic
// order
Route::get('order-statistics', [OrderStatisticController::class, 'getOrderStatistics']);
Route::get('/orders/status-distribution', [OrderStatisticController::class, 'getOrderStatusDistribution']);
Route::get('/orders/top', [OrderStatisticController::class, 'getTopOrders'])->name('orders.top');
Route::get('/statistics/products', [OrderStatisticController::class, 'getProductStatistics']);
Route::get('/monthly-sales', [OrderStatisticController::class, 'getMonthlySalesData']);
Route::get('/monthly-order-product-stats', [OrderStatisticController::class, 'getMonthlyOrderAndProductStats']);


// revenue
Route::get('/category-revenue', [RevenuStatisticController::class, 'getCategoryRevenue']);
Route::get('/category-details', [RevenuStatisticController::class, 'getCategoryDetails']);
Route::get('/revenue-by-payment-method', [RevenuStatisticController::class, 'getRevenueByPaymentMethod']);
Route::get('/monthly-revenue-by-payment-method', [RevenuStatisticController::class, 'getMonthlyRevenueByPaymentMethod']);


// dashboard
Route::get('dashboard/overview', [ChartController::class, 'getOrdersOverview'])->name('dashboard.overview');
Route::get('product-activity', [ChartController::class, 'productActivity']);
Route::get('/customer-stats', [ChartController::class, 'getCustomerStats'])->name('customer_stats');
Route::get('/cart/stats', [ChartController::class, 'getCartStats']);
Route::get('/voucher-usage-rate', [ChartController::class, 'getVoucherUsageRate']);