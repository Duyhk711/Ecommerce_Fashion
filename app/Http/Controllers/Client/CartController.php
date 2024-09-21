<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request)
    {
        $productId = $request['product_id'];
        $productVariantId = $request['product_variant_id'];
        $quantity = $request['quantity'];

        try {
            $this->cartService->addToCart($productId, $productVariantId, $quantity);
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function viewCart()
    {
        $cartItems = $this->cartService->getCartItems();
        return view('client.cart', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        return $this->cartService->updateCart($request);
    }

    public function removeFromCart(Request $request)
    {
        return $this->cartService->removeFromCart($request);
    }
}
