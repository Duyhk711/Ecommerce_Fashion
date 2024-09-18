<?php

namespace App\Http\Controllers\Client;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\AttributeValue;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request)
    {
        // dd($request);
        // Validate the request
        // $validated = $request->validate([
        //     'color_id' => 'required|exists:attribute_values,id',
        //     'size_id' => 'required|exists:attribute_values,id',
        //     'quantity' => 'required|integer|min:1',
        // ]);
        
        $params = $request->post();
        $colorId = AttributeValue::where('value', $params['color_id'])->value('id');
        $sizeId = AttributeValue::where('value', $params['size_id'])->value('id');

        // dd($colorId, $sizeId);
        $productVariantId = DB::table('variant_attributes')
            ->select('product_variant_id')
            ->whereIn('attribute_value_id', [$colorId, $sizeId])
            ->whereNull('deleted_at')
            ->groupBy('product_variant_id')
            ->havingRaw('COUNT(DISTINCT attribute_value_id) = 2')
            ->first()
            ->product_variant_id ?? null;
            $productVariant = ProductVariant::find($productVariantId);
            
        // dd($productVariant->id); // Debug the retrieved product variant
        
        

        if (!$productVariant) {
            return redirect()->back()->with('error', 'Product variant not found.');
        }

        // Add the item to the cart
        $cartService = app(CartService::class);
        $added = $cartService->addToCart($productVariant->id, $params['quantity'], $params['color_id'], $params['size_id']);
        // dd($cartService->addToCart($productVariant->id, $params['quantity'], $params['color_id'], $params['size_id']));
        if ($added) {
            return redirect()->back()->with('success', 'Product added to cart successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to add product to cart.');
        }
    }


    public function showCart()
    {
        $cartItems = $this->cartService->listCartItems();
        $subtotal = 0;
        $total = 0;
        // dd($cartItems);
        foreach ($cartItems as $item) {
            $price = $item['price'];
            $quantity = $item['quantity'];
            $subtotal += $price * $quantity;
            $total = $subtotal;
        }

        return view("client.cart", compact("cartItems", "subtotal", "total"));
    }

    // Phương thức để xóa một mục khỏi giỏ hàng
    public function remove(Request $request)
    {
        $productVariantId = $request->input('product_variant_id');

        // Xóa mục giỏ hàng
        $this->cartService->removeCartItem($productVariantId);

        return response()->json(['success' => true, 'message' => 'Item removed from cart.']);
    }

    // Phương thức để cập nhật số lượng và xóa giỏ hàng
    public function update(Request $request)
    {
        if ($request->has('clear')) {
            // Nếu người dùng nhấn nút Clear thì xóa toàn bộ giỏ hàng
            $this->cartService->clearCart();
            return redirect()->route('cart')->with('success', 'Cart cleared successfully.');
        }

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $quantities = $request->input('quantities', []);
        foreach ($quantities as $productVariantId => $quantity) {
            $this->cartService->updateCartItemQuantity($productVariantId, $quantity);
        }

        return redirect()->route('cart')->with('success', 'Cart updated successfully.');
    }
}
