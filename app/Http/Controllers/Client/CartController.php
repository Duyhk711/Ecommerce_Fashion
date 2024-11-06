<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\Client\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $urlWithoutParams = url()->previous();
        $urlWithoutParams = strtok($urlWithoutParams, '?');
        try {
              $this->cartService->addToCart($productId, $productVariantId, $quantity);
              if ($request->ajax()) {
                  return response()->json([
                      'success' => true,
                      'message' => 'Sản phẩm đã được thêm vào giỏ hàng!'
                  ]);
              }
               return redirect($urlWithoutParams)->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.')
          } catch (\Exception $e) {
              if ($request->ajax()) {
                  return response()->json([
                      'success' => false,
                      'message' => $e->getMessage()
                  ], 500);
              }
              return redirect($urlWithoutParams)->with('error', $e->getMessage());
          }
    }

    public function getCartCount()
    {
        $cartCount = $this->cartService->getCartItemCount();

        return response()->json(['count' => $cartCount]);
    }

    public function viewCart()
    {
        $pageTitle = 'Giỏ hàng';
        $cartItems = $this->cartService->getCartItems();
        // dd($cartItems);
        // dd(session('cart'));
        return view('client.cart', compact('cartItems','pageTitle'));
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
                    'message' => $result['message'],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'],
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình xử lý',
                'error' => $e->getMessage(),
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

    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            // 'product_variant_id' => 'required|exists:product_variants,id',
            // 'quantity' => 'required|integer|min:1',
            // 'price' => 'required|numeric',
        ]);

        $userId = Auth::id();

        if (!$userId) {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->product_variant_id])) {
                $cart[$request->product_variant_id]['quantity'] += $request->quantity;
            } else {
                $cart[$request->product_variant_id] = [
                    'name' => $request->product_name,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'quantity' => $request->quantity,
                    'image' => $request->product_image,
                ];
            }

            session()->put('cart', $cart);

            session()->flash('success', 'Sản phẩm đã được thêm vào giỏ hàng tạm thời.');
        } else {
            $cart = Cart::firstOrCreate(['user_id' => $userId]);

            CartItem::create([
                'cart_id' => $cart->id,
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
            ]);

            session()->flash('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
        }

        return redirect()->back(); // Quay lại trang trước đó
    }
}
