<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Favorite;
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
        $user = auth()->user();
        $products = $this->homeService->getHomeProducts();
        $banners  = $this->homeService->getBannerShowHome();
        $catalogues = $this->homeService->getAllCatalogues();
        $newProducts = $this->homeService->getNewProducts();
        $saleProduct = $this->homeService->getSaleProduct();
        $bestsaleProducts = $this->homeService->getbestsaleProducts();
        $vouchers = $this->homeService->getAllVouchers();
        
        foreach ($newProducts as $product) {
            $product->isFavorite = $user ? Favorite::where('user_id', $user->id)
                                                 ->where('product_id', $product->id)
                                                 ->exists() : false;
        }
    
        foreach ($saleProduct as $product) {
            $product->isFavorite = $user ? Favorite::where('user_id', $user->id)
                                                 ->where('product_id', $product->id)
                                                 ->exists() : false;
        }
    
        foreach ($bestsaleProducts as $product) {
            $product->isFavorite = $user ? Favorite::where('user_id', $user->id)
                                                 ->where('product_id', $product->id)
                                                 ->exists() : false;
        }
        // dd($banners);
        return view('client.home', compact('products', 'banners', 'catalogues', 'newProducts', 'saleProduct', 'bestsaleProducts', 'vouchers'));
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
