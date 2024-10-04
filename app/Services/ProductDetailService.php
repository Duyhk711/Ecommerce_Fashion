<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Comment;
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

    public function getRelatedProducts($product, string $slug)
    {
        // lấy sản phẩm cùng danh mục
        return Product::where('catalogue_id', $product->catalogue_id)
            ->where('id', '!=', $product->id)
            ->get();
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

    public function getCommentsData($product)
    {
        // Lấy user đang đăng nhập
        $currentUserId = auth()->id();

        // Lấy tối đa 2 bình luận cho phần hiển thị chính
        $comments = $product->comments()
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get()
            ->map(function ($comment) use ($currentUserId) {
                return [
                    'id' => $comment->id,
                    'user_name' => $comment->user->name,
                    'user_image' => $comment->user->avatar,
                    'title' => $comment->title,
                    'body' => $comment->comment,
                    'rating' => $comment->rating ?? 'Không đánh giá',
                    'date' => $comment->updated_at ? $comment->updated_at->format('d-m-Y') : $comment->created_at->format('d-m-Y'),
                    'updated_at' => $comment->updated_at,
                    'created_at' => $comment->created_at,
                    'is_owner' => $comment->user_id == $currentUserId,
                ];
            });

        // Lấy tất cả bình luận để hiển thị trong modal
        $allComments = $product->comments()->get()->map(function ($comment) use ($currentUserId) {
            return [
                'id' => $comment->id,
                'user_name' => $comment->user->name,
                'user_image' => $comment->user->avatar,
                'title' => $comment->title,
                'body' => $comment->comment,
                'rating' => $comment->rating ?? 'Không đánh giá',
                'date' => $comment->updated_at ? $comment->updated_at->format('d-m-Y') : $comment->created_at->format('d-m-Y'),
                'is_updated' => $comment->updated_at ? true : false,
                'is_owner' => $comment->user_id == $currentUserId,
            ];
        });

        return [
            'comments' => $comments,
            'total_comments' => $allComments->count(), // Tổng số bình luận
            'all_comments' => $allComments, // Tất cả bình luận để hiển thị trong modal
        ];
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
