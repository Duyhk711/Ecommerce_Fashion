<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Product;
use App\Services\Client\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    // Lấy 12 sản phẩm trang chủ
    public function index()
    {
        $products = $this->homeService->getHomeProducts();
        $banners  = $this->homeService->getBannerShowHome();
        $catalogues = $this->homeService->getAllCatalogues();
        // dd($banners);
        return view('client.home', compact('products', 'banners', 'catalogues'));
    }

    // Tìm kiếm sản phẩm theo tên
    public function search(Request $request)
    {
        $query    = $request->get('query', '');
        $products = $this->homeService->searchProducts($query);
        return view('client.search', compact('products', 'query'));
    }
    
    public function showQuickView($id)
{
    // Tìm sản phẩm theo ID
    $product = Product::find($id);

    // Lấy tất cả biến thể của sản phẩm
    $product_variants = $product->variants;

    // Lấy màu sắc từ biến thể của sản phẩm
    $colors = $product->colors;

    // Lấy kích thước từ biến thể của sản phẩm
    $sizes = $product->sizes;

    // Trả về dữ liệu JSON để sử dụng trong AJAX
    return response()->json([
        'product' => $product,
        'product_variants' => $product_variants,
        'colors' => $colors,
        'sizes' => $sizes,
    ]);
}

}
