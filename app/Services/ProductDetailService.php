<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class ProductDetailService
{
    public function getProduct(string $slug)
    {
        // lấy các mối quan hệ liên quan
        return Product::with("variants.variantAttributes.attributeValue", "images", "comments.user")
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function getVariantDetails($product)
    {
        // lấy ra biến thể chi tiết
        return $product->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'stock' => $variant->stock,
                'price_regular' => $variant->price_regular,
                'price_sale' => $variant->price_sale,
                'attributes' => $variant->variantAttributes->map(function ($attribute) {
                    return [
                        'attributeName' => $attribute->attribute->name,
                        'value' => $attribute->attributeValue->value,
                        'colorCode' => $attribute->attributeValue->color_code ?? null
                    ];
                }),
                'attributeValues' => $variant->variantAttributes->pluck('attributeValue.value')
            ];
        });
    }

    public function calculateTotalStock($product)
    {
        // tổng số lượng các biến thể
        return $product->variants->sum('stock');
    }

    public function getUniqueAttributes($product)
    {
        // lấy biến thể
        return $product->variants->flatMap(function ($variant) {
            return $variant->variantAttributes->map(function ($attribute) use ($variant) {
                return [
                    'attributeName' => $attribute->attribute->name,
                    'value' => $attribute->attributeValue->value,
                    'colorCode' => $attribute->attributeValue->color_code ?? null,
                    'image' => $variant->image ?? null
                ];
            });
        })->unique(function ($item) {
            return $item['attributeName'] . $item['value'] . $item['colorCode'];
        });
    }

    public function getRelatedProducts($product, string $slug)
    {
        $relatedProducts = Product::where('catalogue_id', $product->catalogue_id)
        ->where('id', '!=', $product->id);


        $count = $relatedProducts->count();

        if ($count > 4 && $count < 8) {
            $limit = 4;
        } elseif ($count >= 8) {
            $limit = 8;
        } else {
            $limit = $count; 
        }
        return $relatedProducts->limit($limit)->get();
    }

    public function getUserCommentStatus($product, string $slug)
    {
        // lấy ra trạng thái bình luận (đã bình luận, chưa đăng nhập, chưa mua hàng, có đơn hàng mới chưa bình luận)
        $user = Auth::user();
        $canComment = null;

        if ($user) {
            $hasPurchased = OrderItem::whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->whereHas('productVariant', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })->exists();

            if ($hasPurchased) {
                $latestComment = Comment::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->latest()
                    ->first();
                if ($latestComment) {
                    $latestOrder = OrderItem::whereHas('order', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })->whereHas('productVariant', function ($query) use ($product) {
                        $query->where('product_id', $product->id);
                    })->where('created_at', '>', $latestComment->created_at)->exists();

                    $canComment = $latestOrder ? 'new_purchase' : 'commented';
                } else {
                    $canComment = 'purchased';
                }
            } else {
                $canComment = 'not_purchased';
            }
        } else {
            $canComment = 'not_logged_in';
        }

        return $canComment;
    }

    public function getCommentsData($product, $rating, $perPage = 4)
    {
        $query = $product->comments()->with('user')->orderBy('created_at', 'desc');
    
        if ($rating !== 'all') {
            $query->where('rating', $rating);
        }
    
        return $query->paginate($perPage);
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

    public function isProductFavorite($productId)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            return Favorite::where('user_id', $userId)
                ->where('product_id', $productId)
                ->exists();
        }

        return false; // Nếu người dùng chưa đăng nhập, trả về false
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
}

