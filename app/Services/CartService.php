<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{

    public function addToCart($productVariantId, $quantity, $colorId, $sizeId)
    {
        $productVariant = ProductVariant::find($productVariantId);
        $product_slug = $productVariant->product->slug;
        if (!$productVariant) {
            return false;
        }

        $price = $productVariant->price_sale > 0 ? $productVariant->price_sale : $productVariant->price_regular;

        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id', $productVariantId)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $productVariantId,
                    'quantity' => $quantity,
                    'slug' => $product_slug,
                    'price' => $price,
                    'color_id' => $colorId,
                    'size_id' => $sizeId,
                ]);
            }
        } else {
            $cartItems = Session::get('cart', []);

            $itemExists = false;
            foreach ($cartItems as &$cartItem) {
                if ($cartItem['product_variant_id'] == $productVariantId) {
                    $cartItem['quantity'] += $quantity;
                    $itemExists = true;
                    break;
                }
            }

            if (!$itemExists) {
                $cartItems[] = [
                    'product_variant_id' => $productVariantId,
                    'slug' => $product_slug,
                    'quantity' => $quantity,
                    'price' => $price,
                    'color_id' => $colorId,
                    'size_id' => $sizeId,
                ];
            }

            Session::put('cart', $cartItems);
        }

        return true;
    }

    public function listCartItems()
    {
        if (Auth::check()) {
            // Nếu người dùng đã đăng nhập, lấy giỏ hàng từ cơ sở dữ liệu
            $cart = Cart::where('user_id', Auth::id())->with('items.productVariant.product')->first();

            if ($cart) {
                // Lấy tất cả các mục trong giỏ hàng từ cơ sở dữ liệu
                $cartItems = $cart->items;

                // Gán thông tin sản phẩm cho mỗi item trong giỏ hàng
                foreach ($cartItems as $item) {
                    $product = $item->productVariant->product;
                    $item->product_image = $product->image;
                }

                return $cartItems;
            }
        } else {
            // Nếu người dùng chưa đăng nhập, lấy giỏ hàng từ session
            $cartItems = Session::get('cart', []);
            // dd($cartItems = Session::get('cart', []));
            // Gán thông tin sản phẩm cho mỗi item trong giỏ hàng
            foreach ($cartItems as &$item) {
                $productVariant = ProductVariant::with(['product', 'variantAttributes.attribute', 'variantAttributes.attributeValue'])
                    ->find($item['product_variant_id']);

                if ($productVariant) {
                    $product = $productVariant->product;

                    //Truy xuất màu sắc và kích thước từ các thuộc tính biến thể

                    $color = $size = null;
                    foreach ($productVariant->variantAttributes as $variantAttribute) {
                        if ($variantAttribute->attribute->name === 'Color') {
                            $color = $variantAttribute->attributeValue->value;
                            $item['color_code'] = $variantAttribute->attributeValue->color_code;
                        } elseif ($variantAttribute->attribute->name === 'Size') {
                            $size = $variantAttribute->attributeValue->value;
                        }
                    }

                    $item['product_image'] = $productVariant->product->image;
                    $item['product_name'] = $productVariant->product->name;
                    $item['product_slug'] = $productVariant->product->slug;
                    // dd($item['product_name']);
                    // set lại thuộc tính
                    $item['color'] = $color;
                    $item['size'] = $size;
                }
            }

            return $cartItems;
        }

        // Nếu không có giỏ hàng, trả về mảng rỗng
        return [];
    }

    // Xóa một mục khỏi giỏ hàng
    public function removeCartItem($productVariantId)
    {
        $cartItem = CartItem::where('product_variant_id', $productVariantId)->first();
        if ($cartItem) {
            $cartItem->delete();
        }
    }

    // Xóa toàn bộ giỏ hàng
    public function clearCart()
    {
        CartItem::truncate(); // Xóa toàn bộ dữ liệu trong bảng giỏ hàng
    }

    // Cập nhật số lượng mục trong giỏ hàng
    public function updateCartItemQuantity($productVariantId, $quantity)
    {
        $cartItem = CartItem::where('product_variant_id', $productVariantId)->first();
        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }
    }
}
