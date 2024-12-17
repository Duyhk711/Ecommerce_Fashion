<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Dùng để gọi API bên ngoài
use Illuminate\Support\Facades\Http;
// Nếu bạn lấy bài viết từ database

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', 'fashion clothes');
        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 12);

        // Gọi API
        $response = Http::get("https://newsapi.org/v2/everything", [
            'q' => $query,
            'page' => $page,
            'pageSize' => $pageSize,
            'apiKey' => env('NEWS_API_KEY'),
        ]);

        $data = $response->json();

        if ($response->successful()) {
            // Lọc bài viết liên quan đến fashion hoặc clothes
            $filteredArticles = collect($data['articles'])->filter(function ($article) {
                return str_contains(strtolower($article['title'] ?? ''), 'fashion') ||
                str_contains(strtolower($article['description'] ?? ''), 'fashion') ||
                str_contains(strtolower($article['title'] ?? ''), 'clothes') ||
                str_contains(strtolower($article['description'] ?? ''), 'clothes');
            });

            return response()->json([
                'articles' => $filteredArticles->values()->all(),
                'totalResults' => $filteredArticles->count(),
            ]);
        }

        return response()->json([
            'message' => 'Unable to fetch articles.',
        ], 500);
    }
}
