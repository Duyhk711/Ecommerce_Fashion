<?php

namespace App\Services\Client;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CartService
{
    public function addToCart($productId, $productVariantId, $quantity)
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

        if (Auth::check()) {
            $userId = Auth::id();
            $cart   = Cart::firstOrCreate(['user_id' => $userId]);

            $this->addItemToCart($cart->id, $productVariantId, $quantity, $price);
        } else {
            $cart = Session::get('cart', []);

            if (isset($cart[$productVariantId])) {
                $cart[$productVariantId]['quantity'] += $quantity;
            } else {
                $cart[$productVariantId] = [
                    'product_id'            => $productId,
                    'product_name'          => $variant->product->name,
                    'variant_sku'           => $variant->sku,
                    'variant_attributes'    => $attributes,
                    'image'                 => $variant->image ?: $variant->product->img_thumbnail,
                    'quantity'              => $quantity,
                    'price'                 => $price,
                ];
            }

            Session::put('cart', $cart);
        }
    }


    protected function addItemToCart($cartId, $productVariantId, $quantity, $price)
    {
        $cartItem = CartItem::where('cart_id', $cartId)
            ->where('product_variant_id', $productVariantId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id'               => $cartId,
                'product_variant_id'    => $productVariantId,
                'quantity'              => $quantity,
                'price'                 => $price,
            ]);
        }
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

    public function getCartItems()
    {
        $cartItems = [];

        if (auth()->check()) {
            $userId = auth()->id();
            $cart = Cart::where('user_id', $userId)->first();

            if (!$cart) {
                return collect([]);
            }

            $cartItems = CartItem::with([
                'productVariant.product',
                'productVariant.variantAttributes.attribute',
                'productVariant.variantAttributes.attributeValue'
            ])->where('cart_id', $cart->id)->get();

            // Trả về giỏ hàng đã đăng nhập
            return $cartItems->map(function ($cartItem) {
                $variant = $cartItem->productVariant;
                $product = $variant->product;

                // Xử lý thuộc tính biến thể sản phẩm
                $attributes = $variant->variantAttributes->map(function ($variantAttribute) {
                    return $variantAttribute->attribute->name . ': ' . $variantAttribute->attributeValue->value;
                })->implode(', ');

                return [
                    'cart_item_id'          => $cartItem->id,
                    'product_name'          => $product->name,
                    'variant_sku'           => $variant->sku,
                    'variant_attributes'    => $attributes,
                    'image'                 => $variant->image ?: $product->img_thumbnail,
                    'price'                 => $variant->price_sale ?: $variant->price_regular,
                    'quantity'              => $cartItem->quantity
                ];
            });
        }

        // Nếu người dùng chưa đăng nhập, lấy giỏ hàng từ session
        $cartItems = session()->get('cart', []);

        if (empty($cartItems)) {
            return collect([]);
        }

        // Trả về giỏ hàng từ session (người dùng chưa đăng nhập)
        return collect($cartItems)->map(function ($cartItem) {
            return [
                'id'                    => $cartItem['variant_id'] ?? null,
                'product_name'          => $cartItem['product_name'] ?? 'Unknown Product',
                'variant_sku'           => $cartItem['variant_sku'] ?? 'Unknown SKU',
                'variant_attributes'    => $cartItem['variant_attributes'] ?? 'No Attributes',
                'image'                 => $cartItem['image'] ?? 'default_image.jpg',  
                'price'                 => $cartItem['price'] ?? 0,  
                'quantity'              => $cartItem['quantity'] ?? 1  
            ];
        });
    }

    /**
     * Cập nhật giỏ hàng.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCart(Request $request)
    {
        // Kiểm tra số lượng
        $quantity = $request->input('quantity');
        if (!is_numeric($quantity) || $quantity < 1) {
            return response()->json(['success' => false, 'message' => 'Dữ liệu không hợp lệ: Số lượng không hợp lệ'], 400);
        }

        if (auth()->check()) {
            // Người dùng đã đăng nhập, cập nhật giỏ hàng theo cart_item_id
            return $this->updateLoggedInUserCart($request);
        } else {
            // Người dùng chưa đăng nhập, cập nhật giỏ hàng trong session dựa trên product_variant_id
            return $this->updateSessionCart($request);
        }
    }

    /**
     * Cập nhật giỏ hàng cho người dùng đã đăng nhập.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function updateLoggedInUserCart(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');
        if (!$cartItemId) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy thông tin sản phẩm trong giỏ hàng'], 400);
        }

        $cartItem = CartItem::find($cartItemId);
        if ($cartItem) {
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save();
            return response()->json(['success' => true, 'message' => 'Cập nhật giỏ hàng thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 404);
        }
    }

    /**
     * Cập nhật giỏ hàng trong session cho người dùng chưa đăng nhập.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function updateSessionCart(Request $request)
    {
        $productVariantId = $request->input('product_variant_id');
        if (!$productVariantId) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy thông tin biến thể sản phẩm'], 400);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productVariantId])) {
            // Cập nhật số lượng sản phẩm trong session
            $cart[$productVariantId]['quantity'] = $request->input('quantity');
            session()->put('cart', $cart);
            return response()->json(['success' => true, 'message' => 'Cập nhật giỏ hàng trong session thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'], 404);
        }
    }
    /**
     * Xóa sản phẩm khỏi giỏ hàng.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFromCart(Request $request)
    {
        if (auth()->check()) {
            return $this->removeFromLoggedInUserCart($request);
        } else {
            return $this->removeFromSessionCart($request);
        }
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng cho người dùng đã đăng nhập.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function removeFromLoggedInUserCart(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            $cartItem->delete(); // Xóa sản phẩm khỏi cơ sở dữ liệu

            // Kiểm tra nếu giỏ hàng hiện tại còn trống, nếu trống xóa luôn giỏ hàng
            $cart = Cart::where('user_id', auth()->id())->first();
            if ($cart->items()->count() === 0) {
                $cart->delete(); // Xóa giỏ hàng nếu không còn sản phẩm nào
            }

            // return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng']);
            return redirect()->route('cart.show');
        } else {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng'], 404);
        }
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng trong session cho người dùng chưa đăng nhập.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function removeFromSessionCart(Request $request)
    {
        $productVariantId = $request->input('product_variant_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$productVariantId])) {
            unset($cart[$productVariantId]); 

            // Nếu session giỏ hàng trống sau khi xóa, xóa luôn giỏ hàng
            if (empty($cart)) {
                session()->forget('cart'); 
            } else {
                session()->put('cart', $cart);
            }

            // return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng']);
            return redirect()->route('cart.show');
        } else {
            return redirect()->route('cart.show');
            // return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'], 404);
        }
    }
}
