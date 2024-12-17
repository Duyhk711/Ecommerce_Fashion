<?php

namespace App\Services\Client;

use App\Models\Banner;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;

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
                $product->selected_variant = $product->variants->first(); // Hoặc bất kỳ biến thể nào bạn muốn
                $product->selected_variant_id = $product->selected_variant->id;
                $product->selected_variant_stock = $product->selected_variant->stock;
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

    // Tách từ khóa trong query
    $keywords = preg_split('/\s+/', $query);

    return Product::where(function ($q) use ($keywords) {
        foreach ($keywords as $keyword) {
            $keyword = trim($keyword);
            if (!empty($keyword)) {
                // Tìm kiếm theo tên sản phẩm (ưu tiên khớp chính xác)
                $q->orWhere(function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', '%' . $keyword . '%')
                      ->whereRaw('LENGTH(name) = ?', [strlen($keyword)]);
                })
                  // Tìm kiếm trong danh mục (cũng ưu tiên khớp chính xác)
                  ->orWhereHas('catalogue', function ($q) use ($keyword) {
                      $q->where('name', 'LIKE', '%' . $keyword . '%')
                        ->whereRaw('LENGTH(name) = ?', [strlen($keyword)]);
                  });
            }
        }
    })
    ->where('is_active', 1)  // Chỉ lấy sản phẩm hoạt động
    ->orderByRaw('
        CASE
            WHEN name LIKE ? THEN 1
            WHEN name LIKE ? THEN 2
            ELSE 3
        END', ['%' . $query . '%', $query])
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
    public function getSaleProduct()
    {
        $saleProduct = Product::with(['variants.variantAttributes.attributeValue'])
            ->where('price_regular', '>', 'price_sale')
            ->where('is_active', 1)
            ->where('is_hot_deal', 1)
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
            'products.slug',
            'products.price_regular',
            'products.price_sale',
            'products.img_thumbnail',
            DB::raw('SUM(order_items.quantity) as total_quantity')
        )
            ->leftJoin('order_items', 'products.sku', '=', 'order_items.product_sku') // Sử dụng LEFT JOIN
            ->groupBy('products.id', 'products.name', 'products.slug', 'products.price_regular', 'products.price_sale', 'products.img_thumbnail')
            ->orderBy('total_quantity', 'desc')
            ->where('products.is_active', 1)
            ->take(8)
            ->with(['catalogue', 'variants.variantAttributes.attribute', 'variants.variantAttributes.attributeValue']) // Eager load quan hệ liên quan
            ->get();
        return $bestsaleProducts;
    }

    // voucher
    public function getAllVouchers()
    {
        // Lấy tối đa 3 mã voucher mới nhất từ database, sắp xếp theo thời gian tạo gần nhất
        return Voucher::orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
    }

    public function calculateRatingsPercentage($product)
    {
        // Số lượng đánh giá của từng sao
        // Số lượng đánh giá của từng sao
        $ratingsCount = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];

        // Duyệt qua tất cả các comment
        foreach ($product->comments as $comment) {
            // Nếu comment có rating hợp lệ từ 1 đến 5
            if (!is_null($comment->rating) && $comment->rating >= 1 && $comment->rating <= 5) {
                $ratingsCount[$comment->rating]++;
            }
        }


        return $ratingsCount;
    }

    public function getRatingsForRelatedProducts($relatedProducts)
    {
        // Lấy dữ liệu đánh giá cho từng sản phẩm
        return $relatedProducts->map(function ($product) {
            return [
                'product_id' => $product->id,
                'average_rating' => $this->calculateAverageRating($product),
                'ratings_percentage' => $this->calculateRatingsPercentage($product),
            ];
        });
    }

    public function calculateAverageRating($product)
    {
        // Tính tổng và số lượng rating hợp lệ
        $validRatingsCount = 0; // Số lượng comment có rating hợp lệ (1-5)
        $sumRatings = 0; // Tổng điểm các rating hợp lệ

        foreach ($product->comments as $comment) {
            if (!is_null($comment->rating) && $comment->rating >= 1 && $comment->rating <= 5) {
                $sumRatings += $comment->rating;
                $validRatingsCount++;
            }
        }
        // Trả về trung bình đánh giá, hoặc 0 nếu không có rating hợp lệ
        return $validRatingsCount > 0 ? $sumRatings / $validRatingsCount : 0;
    }
}
