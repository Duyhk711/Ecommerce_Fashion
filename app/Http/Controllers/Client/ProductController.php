<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
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
    

    public function getProductDetail($id, Request $request)
    {

        $product = $this->productDetailService->getProduct($id);
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
        // $isFavorite = $this->productDetailService->isProductFavorite($id);
        $user = auth()->user();
        $isFavorite = $user ? Favorite::where('user_id', $user->id)->where('product_id', $product->id)->exists() : false;
        $relatedRatings = $this->productDetailService->getRatingsForRelatedProducts($relatedProducts);
        foreach ($relatedProducts as $relatedProduct) {
            $relatedProduct->isFavorite = $user ? Favorite::where('user_id', $user->id)
                                                           ->where('product_id', $relatedProduct->id)
                                                           ->exists() : false;
        }
        
        $ratingFilter = $request->input('rating', 'all'); // Lọc theo sao, mặc định là 'all'
        $commentsData = $this->productDetailService->getCommentsData(
            $product,
            $ratingFilter,
            4
        );
        // dd($commentsData);

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
                'ratingsPercentage' => $ratingsPercentage,
                'isFavorite' => $isFavorite,
                'relatedRatings' => $relatedRatings,
                'paginationLinks' => $commentsData->links()->render() // Fix here for pagination
            ]
        );
    }


    
}
