<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Comment;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class ProductDetailService
{
    public function getProductDetail(string $id)
    {
        // Tìm sản phẩm với các quan hệ cần thiết
        $product = Product::with("variants.variantAttributes.attributeValue", "images", "comments.user")
            ->findOrFail($id);

        // Lấy thông tin chi tiết của từng biến thể, bao gồm tồn kho
        $variantDetails = $product->variants->map(function ($variant) {
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

        $user = Auth::user();
        $canComment = null; 
        $hasPurchased = false;
    
        // Kiểm tra nếu người dùng đã đăng nhập
        if ($user) {
            // Kiểm tra xem người dùng có mua sản phẩm hay chưa bằng cách kiểm tra trong bảng `order_items`
            $hasPurchased = OrderItem::whereHas('order', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->whereHas('productVariant', function($query) use ($product) {
                $query->where('product_id', $product->id);
            })->exists();
        
            if ($hasPurchased) {
                // Lấy bình luận cuối cùng của người dùng
                $latestComment = Comment::where('user_id', $user->id)
                                        ->where('product_id', $id)
                                        ->latest() // Sắp xếp theo thời gian tạo, lấy bình luận mới nhất
                                        ->first();
        
                if ($latestComment) {
                    // Kiểm tra xem người dùng có đơn hàng mới hơn sau bình luận cuối cùng hay không
                    $latestOrder = OrderItem::whereHas('order', function($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })->whereHas('productVariant', function($query) use ($product) {
                        $query->where('product_id', $product->id);
                    })->where('created_at', '>', $latestComment->created_at) // Đơn hàng mới hơn bình luận cuối
                    ->exists();
        
                    if ($latestOrder) {
                        $canComment = 'new_purchase'; // Có đơn hàng mới, có thể bình luận lại
                    } else {
                        $canComment = 'commented'; // Đã bình luận, không có đơn hàng mới
                    }
                } else {
                    $canComment = 'purchased'; // Đã mua hàng nhưng chưa bình luận
                }
            } else {
                $canComment = 'not_purchased'; // Đã đăng nhập nhưng chưa mua hàng
            }
        } else {
            $canComment = 'not_logged_in'; // Chưa đăng nhập
        }

        // Tính tổng tồn kho
        $totalStock = $product->variants->sum('stock');

        // Lấy các thuộc tính độc nhất từ biến thể sản phẩm
        $uniqueAttributes = $product->variants->flatMap(function ($variant) {
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

        // Tìm sản phẩm liên quan
        $relatedProducts = Product::where('catalogue_id', $product->catalogue_id)
            ->where('id', '!=', $id)
            ->get();
            

        // Tính toán điểm trung bình đánh giá
        $comments = $product->comments;
        $totalRatings = $comments->count();
        $sumRatings = $comments->sum('rating'); // Tổng số sao của tất cả các đánh giá
        
        if ($totalRatings > 0) {
            $averageRating = $sumRatings / $totalRatings; // Tính trung bình sao
        } else {
            $averageRating = 0; // Nếu không có đánh giá nào
        }

        // Chuẩn bị dữ liệu bình luận
        $commentsData = $comments->map(function ($comment) {
            return [
                'user_name' => $comment->user->name,
                'user_image' => $comment->user->avatar,
                'title' => $comment->title,
                'body' => $comment->comment,
                'rating' => $comment->rating ?? 'Không đánh giá', // Nếu không có rating
            ];
        });

        $ratingsCount = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        foreach ($comments as $comment) {
            if ($comment->rating >= 1 && $comment->rating <= 5) {
                $ratingsCount[$comment->rating]++;
            }
        }
    
        // Tính toán tỷ lệ phần trăm
        $ratingsPercentage = [];
        foreach ($ratingsCount as $rating => $count) {
            $ratingsPercentage[$rating] = $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0;
        }

        return [
            'product' => $product,
            'totalStock' => $totalStock,
            'variantDetails' => $variantDetails,
            'uniqueAttributes' => $uniqueAttributes,
            'relatedProducts' => $relatedProducts,
            'canComment' => $canComment,
            'comments' => $commentsData,
            'averageRating' => $averageRating,
            'totalRatings' => $totalRatings,
            'ratingsPercentage' => $ratingsPercentage
        ];
    }
}
