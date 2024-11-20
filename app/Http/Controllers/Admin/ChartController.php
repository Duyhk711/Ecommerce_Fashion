<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function getRevenueData(Request $request)
    {
        $filterType = $request->input('filterType');
        $data = [];
    
        if ($filterType === 'year') {
            $data = DB::table('orders')
                ->selectRaw('YEAR(created_at) as label, SUM(total_price) as revenue')
                ->whereNotNull('created_at')
                ->groupByRaw('YEAR(created_at)')
                ->orderBy('label')
                ->get();
    
            $data->transform(function ($item) {
                $item->revenue = $item->revenue * 1000;
                return $item;
            });
        } elseif ($filterType === 'month') {
            $year = $request->input('year', date('Y'));
            $data = DB::table('orders')
                ->selectRaw('MONTH(created_at) as label, SUM(total_price) as revenue')
                ->whereYear('created_at', $year)
                ->groupByRaw('MONTH(created_at)')
                ->orderBy('label')
                ->get();
    
            $formattedData = [];
            for ($i = 1; $i <= 12; $i++) {
                $revenue = $data->firstWhere('label', $i)->revenue ?? 0;
                $formattedData[] = [
                    'label' => $i,
                    'revenue' => $revenue * 1000, 
                ];
            }
            $data = collect($formattedData);
        } elseif ($filterType === 'date_range') {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
    
            if (!$startDate || !$endDate) {
                return response()->json(['error' => 'Both start date and end date are required'], 400);
            }
    
            if (!strtotime($startDate) || !strtotime($endDate)) {
                return response()->json(['error' => 'Invalid date format'], 400);
            }
    
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
    
            if ($startDate->greaterThan($endDate)) {
                return response()->json(['error' => 'Start date must be before or equal to end date'], 400);
            }
    
            $data = DB::table('orders')
                ->selectRaw('DATE(created_at) as date, SUM(total_price) as revenue')
                ->whereBetween(DB::raw('DATE(created_at)'), [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                ->groupByRaw('DATE(created_at)')
                ->orderBy('date')
                ->get();
    
            if ($data->isEmpty()) {
                return response()->json(['message' => 'No data found for the selected date range.'], 200);
            }
    
            $data->transform(function ($item) {
                $item->revenue = $item->revenue * 1000;
                $item->date = Carbon::parse($item->date)->format('d-m-Y'); 
                return $item;
            });
        }
    
        return response()->json($data);
    }
    
}
