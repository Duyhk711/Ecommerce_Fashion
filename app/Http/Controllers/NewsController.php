<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function fetchNews()
    {
        $apiKey = 'a046cdd5c3d946f1bea4b8e1cfb4e68f';
        $query = 'fashion+clothes';
        $apiUrl = "https://newsapi.org/v2/everything?q=$query&apiKey=$apiKey&pageSize=100";

        try {
            // Gửi yêu cầu đến API
            $response = Http::get($apiUrl);

            // Kiểm tra lỗi từ API
            if ($response->failed()) {
                return response()->json(['error' => 'Failed to fetch data from API'], 500);
            }

            // Lấy dữ liệu JSON từ API
            $data = $response->json();

            // Lưu dữ liệu vào file JSON trong storage/app
            Storage::put('news_data.json', json_encode($data, JSON_PRETTY_PRINT));

            return response()->json(['success' => 'Data saved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

