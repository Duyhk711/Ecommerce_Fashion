<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Dùng để gọi API bên ngoài
use App\Models\Article; // Nếu bạn lấy bài viết từ database

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', 'fashion clothes'); // Mặc định là 'fashion clothes'
        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 12);

        // Gọi API bên ngoài (ví dụ NewsAPI) hoặc lấy bài viết từ database
        $response = Http::get("https://newsapi.org/v2/everything", [
            'q' => $query,
            'page' => $page,
            'pageSize' => $pageSize,
            'apiKey' => env('NEWS_API_KEY'), // Đảm bảo bạn đã set API_KEY trong .env
        ]);

        $data = $response->json();

        if ($response->successful()) {
            return response()->json([
                'articles' => $data['articles'],
                'totalResults' => $data['totalResults'],
            ]);
        }

        return response()->json([
            'message' => 'Unable to fetch articles.'
        ], 500);
    }
}

