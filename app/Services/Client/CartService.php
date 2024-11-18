<?php

namespace App\Services\Client;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\Log;

class CartService
{
    public function addToCart($productId, $productVariantId, $quantity,$slug)
    {
        $product = Product::with('variants')->findOrFail($productId);
        $price = null;
        $slug = $product->slug;
        // Nếu không có biến thể được chỉ định, chọn ngẫu nhiên một biến thể từ sản phẩm
        if (is_null($productVariantId) && $product->variants->isNotEmpty()) {
            $variant = $product->variants->random();
            $productVariantId = $variant->id;
            $quantity = 1;
            $price = $this->getProductVariantPrice($productVariantId);
        } else {
            // Nếu biến thể đã được chỉ định, kiểm tra giá của biến thể đó
            $price = $this->getProductVariantPrice($productVariantId);
            if ($price === null) {
                throw new \Exception('Giá của biến thể sản phẩm không hợp lệ.');
            }
        }

        $variant = ProductVariant::with(['product', 'variantAttributes.attribute', 'variantAttributes.attributeValue'])
            ->findOrFail($productVariantId);

        $attributes = $variant->variantAttributes->map(function ($variantAttribute) {
            return $variantAttribute->attribute->name . ': ' . $variantAttribute->attributeValue->value;
        })->implode(', ');

        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::firstOrCreate(['user_id' => $userId]);

            $this->addItemToCart($cart->id, $productVariantId, $quantity, $price);
        } else {
            $cart = Session::get('cart', []);

            if (isset($cart[$productVariantId])) {
                $cart[$productVariantId]['quantity'] += $quantity;
            } else {
                $cart[$productVariantId] = [
                    'product_id' => $productId,
                    'product_variant_id' => $productVariantId,
                    'product_name' => $variant->product->name,
                    'variant_attributes' => $attributes,
                    'image' => $variant->image ?: $variant->product->img_thumbnail,
                    'quantity' => $quantity,
                    'stock' => $variant->stock,
                    'price' => $price,
                    'slug' => $slug,
                ];
            }

            Session::put('cart', $cart);
        }
    }

    protected function addItemToCart($cartId, $productVariantId, $quantity, $price)
    {
        $productVariant = ProductVariant::find($productVariantId);
        $maxQuantity = $productVariant->stock;
        $cartItem = CartItem::where('cart_id', $cartId)
            ->where('product_variant_id', $productVariantId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;

            if ($newQuantity > $maxQuantity) {
                $cartItem->quantity = $maxQuantity;
            } else {
                // Nếu không vượt quá, cộng thêm số lượng
                $cartItem->quantity += $quantity;
            }
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cartId,
                'product_variant_id' => $productVariantId,
                'quantity' => $quantity,
                'price' => $price,
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

        // Nếu người dùng đã đăng nhập
        if (auth()->check()) {
            $userId = auth()->id();
            $cart = Cart::where('user_id', $userId)->first();

            if (!$cart) {
                return collect([]);
            }

            // Lấy các sản phẩm trong giỏ hàng và sắp xếp theo `created_at` mới nhất
            $cartItems = CartItem::with([
                'productVariant.product',
                'productVariant.variantAttributes.attribute',
                'productVariant.variantAttributes.attributeValue',
            ])
                ->where('cart_id', $cart->id)
                ->orderBy('created_at', 'desc')
                ->get();

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
                    'slug' => $product->slug
                ];
            });
        }

        // Nếu người dùng chưa đăng nhập, lấy giỏ hàng từ session
        $cartItems = session()->get('cart', []);
        // dd($cartItems);
        if (empty($cartItems)) {
            return collect([]);
        }

        // Trả về giỏ hàng từ session và sắp xếp dựa trên `created_at` nếu có
        return collect($cartItems)->map(function ($cartItem) {
            return [
                'id' => $cartItem['variant_id'] ?? null,
                'product_name' => $cartItem['product_name'] ?? 'Unknown Product',
                'product_variant_id' => $cartItem['product_variant_id'] ?? 'Unknown id',
                'variant_attributes' => $cartItem['variant_attributes'] ?? 'No Attributes',
                'image' => $cartItem['image'] ?? 'default_image.jpg',
                'price' => $cartItem['price'] ?? 0,
                'quantity' => $cartItem['quantity'] ?? 1,
                'stock' => $cartItem['stock'],
                'created_at' => $cartItem['created_at'] ?? now(),
                'slug' => $cartItem['slug'],
            ];
        })->sortByDesc('created_at');
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
            return $this->updateLoggedInUserCart($request);
        } else {
            return $this->updateSessionCart($request);
        }
    }

    public function updateLoggedInUserCart(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');
        if (!$cartItemId) {
            return ['success' => false, 'message' => 'Không tìm thấy thông tin sản phẩm trong giỏ hàng'];
        }

        $cartItem = CartItem::find($cartItemId);
        if ($cartItem) {
            // Lấy thông tin biến thể sản phẩm để kiểm tra số lượng trong kho
            $productVariant = ProductVariant::find($cartItem->product_variant_id);
            if (!$productVariant) {
                return ['success' => false, 'message' => 'Không tìm thấy biến thể sản phẩm'];
            }

            // Kiểm tra số lượng yêu cầu có vượt quá số lượng trong kho không
            $requestedQuantity = $request->input('quantity');
            if ($requestedQuantity > $productVariant->stock) {
                return ['success' => false, 'message' => 'Số lượng yêu cầu vượt quá số lượng trong kho'];
            }

            // Kiểm tra nếu số lượng là hợp lệ
            if ($requestedQuantity < 1) {
                return ['success' => false, 'message' => 'Số lượng phải lớn hơn 0'];
            }

            // Cập nhật số lượng trong giỏ hàng
            $cartItem->quantity = $requestedQuantity;
            $cartItem->save();

            return ['success' => true, 'message' => 'Cập nhật giỏ hàng thành công'];
        } else {
            return ['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng'];
        }
    }

    /**
     * Cập nhật giỏ hàng trong session cho người dùng chưa đăng nhập.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSessionCart(Request $request)
    {
        $productVariantId = $request->input('product_variant_id');
        if (!$productVariantId) {
            return ['success' => false, 'message' => 'Không tìm thấy thông tin biến thể sản phẩm'];
        }

        // Lấy thông tin biến thể sản phẩm để kiểm tra số lượng trong kho
        $productVariant = ProductVariant::find($productVariantId);
        if (!$productVariant) {
            return ['success' => false, 'message' => 'Không tìm thấy biến thể sản phẩm'];
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productVariantId])) {
            // Kiểm tra số lượng yêu cầu có vượt quá số lượng trong kho không
            $requestedQuantity = $request->input('quantity');
            if ($requestedQuantity > $productVariant->stock) {
                return ['success' => false, 'message' => 'Số lượng yêu cầu vượt quá số lượng trong kho'];
            }

            // Kiểm tra nếu số lượng là hợp lệ
            if ($requestedQuantity < 1) {
                return ['success' => false, 'message' => 'Số lượng phải lớn hơn 0'];
            }

            // Cập nhật số lượng trong giỏ hàng
            $cart[$productVariantId]['quantity'] = $requestedQuantity;
            session()->put('cart', $cart);

            return ['success' => true, 'message' => 'Cập nhật giỏ hàng trong session thành công'];
        } else {
            return ['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'];
        }
    }

    public function removeFromLoggedInUserCart(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');
        $cartItem = CartItem::find($cartItemId);

        // Log::info('Cart Item ID:', ['id' => $cartItemId]);
        // Log::info('Cart Item:', ['item' => $cartItem]);

        if (!$cartItem) {
            return ['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng'];
        }
        // dd($cartItemId, $cartItem);
        $cartItem->delete();

        $cart = Cart::where('user_id', auth()->id())->first();
        if ($cart && $cart->items()->count() === 0) {
            $cart->delete();
        }
        // return redirect()->route('cart.show');
        return ['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng'];
    }

    public function removeFromSessionCart(Request $request)
    {
        $productVariantId = $request->input('product_variant_id');
        $cart = session()->get('cart', []);
        // Log::info('Product Variant ID:', ['id' => $productVariantId]);
        // Log::info('Session Cart before removal:', ['cart' => $cart]);
        if (!isset($cart[$productVariantId])) {
            return ['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'];
        }

        unset($cart[$productVariantId]);

        if (empty($cart)) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return ['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng'];
    }

    public function getCartItemCount()
    {
        if (Auth::check()) {
            // Đã đăng nhập, lấy số lượng sản phẩm trong giỏ hàng từ cơ sở dữ liệu
            $cart = Cart::where('user_id', Auth::id())->first();

            if ($cart) {
                // Lấy tổng số item chưa bị xóa
                return $cart->items()->whereNull('deleted_at')->count(); // Đếm số lượng item
            }
            return 0; // Không có giỏ hàng
        } else {
            // Chưa đăng nhập, lấy số lượng sản phẩm trong giỏ hàng từ session
            $cart = Session::get('cart', []);
            return count($cart); // Đếm số lượng sản phẩm trong session cart
        }
    }
}
