<?php

namespace App\Services\Client;

use App\Mail\OrderConfirmation;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutService
{
    public function reduceQuantity(ProductVariant $productVariant, $quantity)
    {
        // Trừ số lượng
        $productVariant->stock -= $quantity;

        // Lưu thay đổi vào cơ sở dữ liệu
        $productVariant->save();
    }

    public function getAddresses()
    {

        $addresses = Address::where('user_id', Auth::user()->id)->get();
        return $addresses;
    }

    public function getCartItems($selectedItems = [])
    {
        $cartItems = [];

        // Nếu người dùng đã đăng nhập
        if (Auth::check()) {
            $userId = auth()->id();
            $cart = Cart::where('user_id', $userId)->first();

            if (!$cart) {
                return collect([]);
            }
            // dd('ok1');
            $query = CartItem::with([
                'productVariant.product',
                'productVariant.variantAttributes.attribute',
                'productVariant.variantAttributes.attributeValue',
            ])
                ->where('cart_id', $cart->id);

            // Nếu có các sản phẩm đã được chọn, thêm điều kiện vào truy vấn
            if (!empty($selectedItems)) {
                $query->whereIn('product_variant_id', $selectedItems);
            }

            // Sắp xếp các sản phẩm theo thời gian tạo mới nhất
            $cartItems = $query->orderBy('created_at', 'desc')->get();

            // Trả về giỏ hàng đã đăng nhập
            return $cartItems->map(function ($cartItem) {
                $variant = $cartItem->productVariant;
                $product = $variant->product;

                // Xử lý thuộc tính biến thể sản phẩm
                $attributes = $variant->variantAttributes->map(function ($variantAttribute) {
                    return $variantAttribute->attribute->name . ': ' . $variantAttribute->attributeValue->value;
                })->implode(', ');

                return [
                    'cart_item_id' => $cartItem->id,
                    'product_name' => $product->name,
                    'product_variant_id' => $variant->id,
                    'variant_attributes' => $attributes,
                    'image' => $variant->image ?: $product->img_thumbnail,
                    'price' => $variant->price_sale ?: $variant->price_regular,
                    'quantity' => $cartItem->quantity,
                    'stock' => $variant->stock,
                    'created_at' => $cartItem->created_at,
                ];
            });
        }

        // dd('ok2');
        // Nếu người dùng chưa đăng nhập, lấy giỏ hàng từ session
        $cartItems = session()->get('cart', []);
        // dd($cartItems);
        if (empty($cartItems)) {
            return collect([]);
        }

        if (!empty($selectedItems)) {
            $cartItems = array_filter($cartItems, function ($item) use ($selectedItems) {
                return in_array($item['product_variant_id'], $selectedItems);
            });
        }
        // Trả về giỏ hàng từ session và sắp xếp dựa trên `created_at` nếu có
        return collect($cartItems)->map(function ($cartItem) {
            return [
                'cart_item_id' => $cartItem['variant_id'] ?? null,
                'product_name' => $cartItem['product_name'] ?? 'Unknown Product',
                'product_variant_id' => $cartItem['product_variant_id'] ?? 'Unknown id',
                'variant_attributes' => $cartItem['variant_attributes'] ?? 'No Attributes',
                'image' => $cartItem['image'] ?? 'default_image.jpg',
                'price' => $cartItem['price'] ?? 0,
                'quantity' => $cartItem['quantity'] ?? 1,
                'stock' => $cartItem['stock'],
                'created_at' => $cartItem['created_at'] ?? now(),
            ];
        })->sortByDesc('created_at');
    }

    public function buyNow($productVariantId, $quantity)
    {
        $price = $this->getProductVariantPrice($productVariantId);

        if ($price === null) {
            throw new \Exception('Giá của biến thể sản phẩm không hợp lệ.');
        }

        $variant = ProductVariant::with(['product', 'variantAttributes.attribute', 'variantAttributes.attributeValue'])
            ->findOrFail($productVariantId);

        $attributes = $variant->variantAttributes->map(function ($variantAttribute) {
            return $variantAttribute->attribute->name . ': ' . $variantAttribute->attributeValue->value;
        })->implode(', ');

        $cartItem = [];
        $cartItem[$productVariantId] = [
            'cart_item_id' => $productVariantId ?? null,
            'product_variant_id' => $productVariantId,
            'product_name' => $variant->product->name,
            'variant_attributes' => $attributes,
            'image' => $variant->image ?: $variant->product->img_thumbnail,
            'quantity' => $quantity,
            'stock' => $variant->stock,
            'price' => $price,
            'created_at' => now(),
        ];

        return $cartItem;

    }

    protected function getProductVariantPrice($productVariantId)
    {
        $variant = ProductVariant::find($productVariantId);
        if ($variant) {
            if (!isset($variant->price_sale)) {
                throw new \Exception('Giá biến thể sản phẩm không tồn tại.');
            }
            return $variant->price_sale;
        } else {
            throw new \Exception('Biến thể sản phẩm không tồn tại.');
        }
    }

    public function sendOrderConfirmationNotification($order)
    {
        Mail::to($order->customer_email)->queue(new OrderConfirmation($order));

    }

    public function store(Request $request)
    {

    }

    public function updateOrder()
    {
        //
    }

    public function updateOrderItem()
    {
        //
    }

}
