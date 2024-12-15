<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ProductDetailService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\JsonLd;


class ProductController extends Controller
{
    protected $productDetailService;

    public function __construct(ProductDetailService $productDetailService)
    {
        $this->productDetailService = $productDetailService;
    }


    public function getProductDetail($id, Request $request)
    {
        // Lấy thông tin sản phẩm
        $product = $this->productDetailService->getProduct($id);
        SEOMeta::setTitle($product->meta_title ?? $product->name);
        SEOMeta::setDescription($product->meta_description ?? Str::limit($product->description, 150));
        SEOMeta::setCanonical(route('productDetail', ['slug' => $product->slug]));
        SEOMeta::addKeyword($product->meta_keywords);

        OpenGraph::setTitle($product->meta_title ?? $product->name);
        OpenGraph::setDescription($product->meta_description ?? Str::limit($product->description, 150));
        OpenGraph::setUrl(route('productDetail', ['slug' => $product->slug]));
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addImage(asset('storage/' . $product->img_thumbnail));

        JsonLd::setTitle($product->meta_title ?? $product->name);
        JsonLd::setDescription($product->meta_description ?? Str::limit($product->description, 150));
        JsonLd::addImage(asset('storage/' . $product->img_thumbnail));

        // Thông tin khác liên quan đến sản phẩm
        $variantDetails = $this->productDetailService->getVariantDetails($product);
        $totalStock = $this->productDetailService->calculateTotalStock($product);
        $uniqueAttributes = $this->productDetailService->getUniqueAttributes($product);
        $relatedProducts = $this->productDetailService->getRelatedProducts($product, $id);

        foreach ($relatedProducts as $relatedProduct) {
            $relatedProduct->uniqueAttributes = $this->productDetailService->getUniqueAttributes($relatedProduct);
        }

        $canComment = $this->productDetailService->getUserCommentStatus($product, $id);
        $averageRating = $this->productDetailService->calculateAverageRating($product);
        $ratingsPercentage = $this->productDetailService->calculateRatingsPercentage($product);
        $user = auth()->user();
        $isFavorite = $user ? Favorite::where('user_id', $user->id)->where('product_id', $product->id)->exists() : false;
        foreach ($relatedProducts as $relatedProduct) {
            $relatedProduct->isFavorite = $user ? Favorite::where('user_id', $user->id)
                ->where('product_id', $relatedProduct->id)
                ->exists() : false;
        }
        $relatedRatings = $this->productDetailService->getRatingsForRelatedProducts($relatedProducts);
        // Kiểm tra nếu có tham số cho bình luận
        if ($request->has('rating') || $request->ajax()) {
            $ratingFilter = $request->input('rating', 'all'); // Lọc theo sao
            $commentsData = $this->productDetailService->getCommentsData($product, $ratingFilter, 3);

            $paginationHtml = $commentsData->appends(['rating' => $ratingFilter])->links()->render();
            return response()->json([
                'html' => view('client.partials.comment-list', ['comments' => $commentsData])->render(),
                'pagination' => $paginationHtml
            ]);
        }


        // Nếu không có yêu cầu AJAX, trả về view bình thường
        return view('client.product-detail', [
            'product' => $product,
            'totalStock' => $totalStock,
            'variantDetails' => $variantDetails,
            'uniqueAttributes' => $uniqueAttributes,
            'relatedProducts' => $relatedProducts,
            'canComment' => $canComment,
            'averageRating' => $averageRating,
            'totalRatings' => $product->comments->count(),
            'ratingsPercentage' => $ratingsPercentage,
            'isFavorite' => $isFavorite,
            'relatedRatings' => $relatedRatings,
            'comments' => $this->productDetailService->getCommentsData($product, 'all', 3),
            'paginationLinks' => $this->productDetailService->getCommentsData($product, 'all', 3)->links()->render() // Fix here for pagination
        ]);
    }
}
