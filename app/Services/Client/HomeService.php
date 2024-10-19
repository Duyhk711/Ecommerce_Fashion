<?php

namespace App\Services\Client;

use App\Models\Banner;
use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeService
{
    // Lấy 12 sản phẩm trang chủ
    public function getHomeProducts()
    {
        $products = Product::with(['variants.variantAttributes.attributeValue'])
            ->where('is_show_home', 1)
            ->where('is_active', 1)
            ->take(8)
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
    public function getAllCatalogues()
    {
        return Catalogue::all();
    }
    //sản phẩm mới
    public function getNewProducts()
    {
    $newProducts = Product::with(['variants.variantAttributes.attributeValue'])
        ->where('is_new', 1) 
        ->where('is_active', 1)
        ->orderBy('created_at', 'desc')
        ->take(8) 
        ->get();

    return $newProducts;
    }
    // sản phẩm giảm giá
    public function getSaleProduct(){
        $saleProduct = Product::with(['variants.variantAttributes.attributeValue'])
        ->where('price_regular', '>', 'price_sale') 
        ->where('is_active', 1) 
        ->orderBy('created_at', 'desc') 
        ->take(8) 
        ->get();
        return $saleProduct;
    }
    // sản phẩm bán chạy
    public function getBestsaleProducts()
    {
        // Truy vấn sản phẩm bán chạy dựa trên số lượng SKU trong bảng orders
        $bestsaleProducts = Product::select(
            'products.id',
            'products.name',
            'products.price_regular',
            'products.price_sale',
            'products.img_thumbnail',
            DB::raw('SUM(order_items.quantity) as total_quantity')
        )
        ->join('order_items', 'products.sku', '=', 'order_items.product_sku')
        ->groupBy('products.id', 'products.name', 'products.price_regular', 'products.price_sale', 'products.img_thumbnail')
        ->orderBy('total_quantity', 'desc')
        ->where('products.is_active', 1)
        ->take(12)
        ->get();
       

        return $bestsaleProducts;
    }

}
