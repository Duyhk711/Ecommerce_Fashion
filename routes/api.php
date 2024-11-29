<?php

use App\Http\Controllers\Admin\ChartController;
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
Route::get('/total-income', [ChartController::class, 'getTotalIncome'])->name('api.total-income');

Route::get('/total-orders', [ChartController::class, 'getTotalOrders'])->name('api.total-orders');
Route::get('/total-customers', [ChartController::class, 'getTotalCustomers']);
Route::get('/stats/total-sold-products', [ChartController::class, 'getTotalSoldProducts']);

Route::get('/revenue-data', [ChartController::class, 'getRevenueData']);
Route::get('revenue/monthly/{year}', [ChartController::class, 'getMonthlyRevenue']);
Route::get('revenue/daily/{year}/{month}', [ChartController::class, 'getDailyRevenue']);
Route::get('/revenue/daily-range/{startDate}/{endDate}', [ChartController::class, 'getRevenueByDateRange']);
Route::get('/orders/status-distribution', [ChartController::class, 'getOrderStatusDistribution']);
Route::get('/orders', [ChartController::class, 'getOrders']);

Route::get('/sales-statistics', [ChartController::class, 'getSalesStatistics']);
Route::get('/products/top-rated', [ChartController::class, 'topRatedProducts']);