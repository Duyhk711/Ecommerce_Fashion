<?php

namespace App\Services\Client;

use App\Models\Banner;
use App\Models\Catalogue;
use App\Models\Product;

class HomeService
{
    // Lấy 12 sản phẩm trang chủ
    public function getHomeProducts()
    {
        // Lấy sản phẩm cùng với biến thể và các thông tin liên quan
        $products = Product::with([
            'variants.variantAttributes.attribute', // Load thuộc tính của biến thể
            'variants.variantAttributes.attributeValue', // Load giá trị của thuộc tính
        ])
            ->where('is_show_home', 1)  // Điều kiện để lấy sản phẩm hiển thị trên trang chủ
            ->where('is_active', 1)     // Điều kiện lấy sản phẩm đang hoạt động
            ->take(12)                  // Lấy 12 sản phẩm
            ->get();
            
            foreach ($products as $product) {
                if ($product->variants->isNotEmpty()) {
                    // Lấy ngẫu nhiên một biến thể, hoặc có thể thay đổi logic theo nhu cầu
                    $product->selected_variant = $product->variants->first(); // Hoặc bất kỳ biến thể nào bạn muốn
                    $product->selected_variant_id = $product->selected_variant->id; 
                    $product->selected_variant_stock= $product->selected_variant->stock; 
                }
            }
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
    public function getAllCatalogues()
    {
        return Catalogue::all();
    }
}
