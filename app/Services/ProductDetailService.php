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
    public function getProduct(string $id)
    {
        // lấy các mối quan hệ liên quan
        return Product::with("variants.variantAttributes.attributeValue", "images", "comments.user")
            ->findOrFail($id);
    }

    public function getVariantDetails($product)
    {
        // lấy ra biến thể chi tiết
        return $product->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'stock' => $variant->stock,
                'attributes' => $variant->variantAttributes->map(function ($attribute) {
                    return [
                        'attributeName' => $attribute->attribute->name,
                        'value' => $attribute->attributeValue->value,
                        'colorCode' => $attribute->attributeValue->color_code ?? null
                    ];
                })
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
            return $variant->variantAttributes->map(function ($attribute) {
                return [
                    'attributeName' => $attribute->attribute->name,
                    'value' => $attribute->attributeValue->value,
                    'colorCode' => $attribute->attributeValue->color_code ?? null
                ];
            });
        })->unique(function ($item) {
            return $item['attributeName'] . $item['value'] . $item['colorCode'];
        });
    }

    public function getRelatedProducts($product, string $id)
    {
        // lấy sản phẩm cùng danh mục
        return Product::where('catalogue_id', $product->catalogue_id)
            ->where('id', '!=', $id)
            ->get();
    }

    public function getUserCommentStatus($product, string $id)
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
                    ->where('product_id', $id)
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

    public function getCommentsData($product)
    {
        // lấy dữ liệu bình luận
        return $product->comments->map(function ($comment) {
            return [
                'user_name' => $comment->user->name,
                'user_image' => $comment->user->avatar,
                'title' => $comment->title,
                'body' => $comment->comment,
                'rating' => $comment->rating ?? 'Không đánh giá',
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

    public function calculateRatingsPercentage($product)
    {
        // Số lượng đánh giá của từng sao
        $ratingsCount = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        $validRatingsCount = 0; // Số lượng comment có rating hợp lệ (1-5)

        // Duyệt qua tất cả các comment
        foreach ($product->comments as $comment) {
            // Nếu comment có rating hợp lệ từ 1 đến 5
            if (!is_null($comment->rating) && $comment->rating >= 1 && $comment->rating <= 5) {
                $ratingsCount[$comment->rating]++;
                $validRatingsCount++; // Tăng số lượng rating hợp lệ
            }
        }

        $totalRatings = $validRatingsCount; // Chỉ tính những rating hợp lệ
        $ratingsPercentage = [];

        // Tính phần trăm cho từng mức rating
        foreach ($ratingsCount as $rating => $count) {
            // Nếu tổng số rating hợp lệ lớn hơn 0, tính phần trăm, nếu không thì trả về 0
            $ratingsPercentage[$rating] = $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0;
        }

        return $ratingsPercentage;
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
}
