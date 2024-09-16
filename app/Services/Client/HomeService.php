<?php

namespace App\Services\Client;
use App\Models\Banner;
use App\Models\Product;

class HomeService
{
  // lấy 12 sp trang chủ
    public function getHomeProducts()
    {
        $products = Product::with(['variants.variantAttributes.attributeValue'])
            ->where('is_show_home', 1)
            ->where('is_active', 1)
            ->take(12)
            ->get();
        return $products;
    }

    // Tìm kiếm sản phẩm theo tên
    public function searchProducts($query)
    {
        $query = trim($query);

        if (empty($query)) {
            return collect();
        }

        return Product::where('name', 'LIKE', '%' . $query . '%')
            ->where('is_active', 1)
            ->get();
    }


    public function getBannerShowHome()
    {
        $mainBanners = Banner::where('type', 'main')->where('is_active', true)->get();
        $topBanners = Banner::where('type', 'sub')->where('position', 'top')->where('is_active', true)->get();
        $middleBanners = Banner::where('type', 'sub')->where('position', 'middle')->where('is_active', true)->get();

        return [
            'mainBanners' => $mainBanners,
            'topBanners' => $topBanners,
            'middleBanners' => $middleBanners,
        ];
    }
}
