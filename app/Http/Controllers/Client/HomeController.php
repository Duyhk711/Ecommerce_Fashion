<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Favorite;
use App\Models\Product;
use App\Services\Client\HomeService;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;

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
        SEOMeta::setTitle('Poly Fashion - Trang chủ');
        SEOMeta::setDescription('Thương mại điện tử bán quần áo chất lượng cao với nhiều khuyến mãi hấp dẫn.');
        SEOMeta::setCanonical(route('home'));

        OpenGraph::setTitle('Poly Fashion - Trang chủ');
        OpenGraph::setDescription('Thương mại điện tử bán quần áo chất lượng cao với nhiều khuyến mãi hấp dẫn.');
        OpenGraph::setUrl(route('home'));
        OpenGraph::addProperty('type', 'website');

        JsonLd::setTitle('Poly Fashion - Trang chủ');
        JsonLd::setDescription('Thương mại điện tử bán quần áo chất lượng cao với nhiều khuyến mãi hấp dẫn.');
        JsonLd::addImage(asset('client/images/title.png'));
        $user = auth()->user();
        $products = $this->homeService->getHomeProducts();
        $banners  = $this->homeService->getBannerShowHome();
        $catalogues = $this->homeService->getAllCatalogues();
        $newProducts = $this->homeService->getNewProducts();
        $saleProduct = $this->homeService->getSaleProduct();
        $bestsaleProducts = $this->homeService->getbestsaleProducts();
        $vouchers = $this->homeService->getAllVouchers();
        $newRatings = $this->homeService->getRatingsForRelatedProducts($newProducts);
        $saleRatings = $this->homeService->getRatingsForRelatedProducts($saleProduct);
        $bestsaleRatings = $this->homeService->getRatingsForRelatedProducts($bestsaleProducts);
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
        return view('client.home', compact(
            'products',
            'banners',
            'catalogues',
            'newProducts',
            'saleProduct',
            'bestsaleProducts',
            'vouchers',
            'newRatings',
            'saleRatings',
            'bestsaleRatings'
        ));
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $query = $request->get('query', '');
        
        // Kiểm tra nếu query rỗng
        if (empty($query)) {
            $products = collect();  // Khởi tạo mảng rỗng nếu không có truy vấn
            return view('client.search', compact('products', 'query'));
        }
    
        // Tìm kiếm sản phẩm dựa trên từ khóa
        $products = $this->homeService->searchProducts($query);
        
        // Nếu không tìm thấy sản phẩm chính xác, đề xuất sản phẩm liên quan
        if ($products->isEmpty()) {
            $suggestedProducts = $this->homeService->suggestRelatedProducts($query);
        } else {
            $suggestedProducts = collect(); // Không có đề xuất nếu có sản phẩm tìm thấy
        }
    
        // Cập nhật xem sản phẩm có phải là yêu thích của người dùng không
        foreach ($products as $product) {
            $product->isFavorite = $user ? Favorite::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->exists() : false;
        }
    
        // Cập nhật đề xuất sản phẩm
        foreach ($suggestedProducts as $product) {
            $product->isFavorite = $user ? Favorite::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->exists() : false;
        }
    
        // Thiết lập SEO meta cho trang tìm kiếm
        SEOMeta::setTitle("Tìm kiếm sản phẩm: $query - Poly Fashion");
        SEOMeta::setDescription("Kết quả tìm kiếm cho từ khóa '$query' trên Poly Fashion.");
        SEOMeta::setKeywords($query);  // Chỉ sử dụng từ khóa người dùng nhập vào
    
        OpenGraph::setTitle("Tìm kiếm sản phẩm: $query - Poly Fashion");
        OpenGraph::setDescription("Kết quả tìm kiếm cho từ khóa '$query' trên Poly Fashion.");
        OpenGraph::setUrl(route('search') . "?query=" . urlencode($query));
    
        return view('client.search', compact('products', 'query', 'suggestedProducts'));
    }
}
