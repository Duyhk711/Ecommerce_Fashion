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
        // dd($cartItems);
        return view('client.cart', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        try {
            if (auth()->check()) {
                $result = $this->cartService->updateLoggedInUserCart($request);
            } else {
                $result = $this->cartService->updateSessionCart($request);
            }

            // Kiểm tra kết quả trả về từ CartService
            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message']
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình xử lý',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function removeFromCart(Request $request)
    {
        // dd($request);
        if (auth()->check()) {
            $result = $this->cartService->removeFromLoggedInUserCart($request);
        } else {
            $result = $this->cartService->removeFromSessionCart($request);
        }

        if ($result['success']) {
            return response()->json($result, 200);
        } else {
            return response()->json($result, 400);
        }
    }
}