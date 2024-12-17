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

    $products = Product::with([
        'catalogue',
        'mainImage',
        'variants.variantAttributes.attribute',
        'variants.variantAttributes.attributeValue',
        'images'
    ])
    ->where(function ($q) use ($query) {
        $q->where('name', 'like', '%' . $query . '%') // Tìm kiếm theo tên sản phẩm
          ->orWhere('sku', 'like', '%' . $query . '%') // Tìm kiếm theo SKU
          ->orWhereHas('catalogue', function ($q) use ($query) {
              $q->where('name', 'like', '%' . $query . '%'); // Tìm kiếm theo tên danh mục
          });
    })
    ->where('is_active', 1) // Chỉ lấy sản phẩm đang hoạt động
    ->orderByRaw('
        CASE
            WHEN name LIKE ? THEN 1  -- Nếu tên sản phẩm khớp chính xác
            WHEN name LIKE ? THEN 2  -- Nếu tên sản phẩm khớp gần đúng
            ELSE 3
        END', ['%' . $query . '%', $query]) // Ưu tiên kết quả tìm kiếm chính xác hơn
    ->get();

    // Cập nhật xem sản phẩm có phải là yêu thích của người dùng không
    foreach ($products as $product) {
        $product->isFavorite = $user ? Favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->exists() : false;
    }

    // Thiết lập SEO meta cho trang tìm kiếm
    SEOMeta::setTitle("Tìm kiếm sản phẩm: $query - Poly Fashion");
    SEOMeta::setDescription("Kết quả tìm kiếm cho từ khóa '$query' trên Poly Fashion.");
    SEOMeta::setKeywords($query);

    OpenGraph::setTitle("Tìm kiếm sản phẩm: $query - Poly Fashion");
    OpenGraph::setDescription("Kết quả tìm kiếm cho từ khóa '$query' trên Poly Fashion.");
    OpenGraph::setUrl(route('search') . "?query=" . urlencode($query));

    return view('client.search', compact('products', 'query'));
}

}
