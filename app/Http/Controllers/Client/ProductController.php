<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ProductDetailService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productDetailService;

    public function __construct(ProductDetailService $productDetailService){
        $this->productDetailService = $productDetailService;
    }
    

    public function getProductDetail($id){
        $product = $this->productDetailService->getProduct($id);
        $variantDetails = $this->productDetailService->getVariantDetails($product);
        $totalStock = $this->productDetailService->calculateTotalStock($product);
        $uniqueAttributes = $this->productDetailService->getUniqueAttributes($product);
        $relatedProducts = $this->productDetailService->getRelatedProducts($product, $id);
        $canComment = $this->productDetailService->getUserCommentStatus($product, $id);
        $commentsData = $this->productDetailService->getCommentsData($product);
        $averageRating = $this->productDetailService->calculateAverageRating($product);
        $ratingsPercentage = $this->productDetailService->calculateRatingsPercentage($product);
        return view('client.product-detail', 
            [   
                'product' => $product,
                'totalStock' => $totalStock,
                'variantDetails' => $variantDetails,
                'uniqueAttributes' => $uniqueAttributes,
                'relatedProducts' => $relatedProducts,
                'canComment' => $canComment,
                'comments' => $commentsData,
                'averageRating' => $averageRating,
                'totalRatings' => $product->comments->count(),
                'ratingsPercentage' => $ratingsPercentage
            ]   

        );
    }
    
}
