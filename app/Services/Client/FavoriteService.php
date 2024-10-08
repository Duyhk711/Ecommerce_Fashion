<?php

namespace App\Services\Client;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteService
{
    /**
     * Thêm sản phẩm vào danh sách yêu thích.
     *
     * @param int $productId
     * @throws \Exception
     */
    public function addToFavorites($productId)
    {
        if (!Auth::check()) {
            throw new \Exception('Bạn cần phải đăng nhập để thêm sản phẩm vào danh sách yêu thích.');
        }

        $userId = Auth::id();

        // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
        $favorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            throw new \Exception('Sản phẩm này đã có trong danh sách yêu thích.');
        }

        // Thêm sản phẩm vào danh sách yêu thích
        Favorite::create([
            'user_id'    => $userId,
            'product_id' => $productId,
        ]);
    }

    /**
     * Lấy danh sách yêu thích của người dùng.
     *
     */
    public function getFavorites()
    {
        if (Auth::check()) {
            return Favorite::with('product', 'productVariant')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            return [];
        }
    }

    /**
     * Xóa khỏi danh sách yêu thích.
     *
     */
    public function removeFromFavorites($productId, $productVariantId = null)
    {
        if (Auth::check()) {
            $userId = Auth::id();

            Favorite::where('user_id', $userId)
                ->where('product_id', $productId)
                ->when($productVariantId, function ($query, $variantId) {
                    return $query->where('product_variant_id', $variantId);
                })
                ->delete();
        }
    }
}
