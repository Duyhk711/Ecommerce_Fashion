<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {

        return view('admin.statistics.index');
    }
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

    public function getTotalIncomeByWeek()
    {
        try {
            // Lấy ngày bắt đầu và kết thúc của tuần hiện tại
            $startOfWeek = today()->startOfWeek(); // Thứ Hai
            $endOfWeek = today()->endOfDay(); // Hôm nay

            // Lấy ngày bắt đầu và kết thúc của tuần trước
            $startOfLastWeek = today()->subWeek()->startOfWeek(); // Thứ Hai tuần trước
            $endOfLastWeek = today()->subWeek()->endOfWeek(); // Chủ Nhật tuần trước

            // Tổng thu nhập tuần hiện tại (tới hôm nay)
            $totalIncomeThisWeek = DB::table('orders')
                ->where('status', '4') // Chỉ tính những đơn hàng hoàn thành
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->sum('total_price') * 1000;

            // Lấy các ngày có dữ liệu trong tuần trước
            $daysWithDataLastWeek = DB::table('orders')
                ->selectRaw('DATE(created_at) as date')
                ->where('status', '4')
                ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
                ->groupBy(DB::raw('DATE(created_at)'))
                ->pluck('date'); // Lấy danh sách ngày có dữ liệu

            // Tổng thu nhập tuần trước chỉ tính cho các ngày có dữ liệu
            $totalIncomeLastWeek = DB::table('orders')
                ->where('status', '4')
                ->whereIn(DB::raw('DATE(created_at)'), $daysWithDataLastWeek)
                ->sum('total_price') * 1000;

            // Đảm bảo không bị null
            $totalIncomeThisWeek = $totalIncomeThisWeek ?: 0;
            $totalIncomeLastWeek = $totalIncomeLastWeek ?: 0;

            // Tính phần trăm thay đổi
            $percentChange = $totalIncomeLastWeek > 0
                ? (($totalIncomeThisWeek - $totalIncomeLastWeek) / $totalIncomeLastWeek) * 100
                : ($totalIncomeThisWeek > 0 ? 100 : 0);

            return response()->json([
                'total_income_this_week' => $totalIncomeThisWeek,
                'total_income_last_week' => $totalIncomeLastWeek,
                'percent_change' => $percentChange,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch total income',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
