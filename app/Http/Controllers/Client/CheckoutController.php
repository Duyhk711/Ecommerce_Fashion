<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Services\Client\CartService;
use App\Services\Client\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected $checkoutService;
    protected $cartService;

    public function __construct(CheckoutService $checkoutService, CartService $cartService)
    {
        $this->checkoutService = $checkoutService;
        $this->cartService = $cartService;
    }

    public function renderCheckout(Request $request)
    {

        if (Auth::check()) {
            $dataAddress = $this->checkoutService->getAddresses();
            if ($request->has('address')) {
                $address = $dataAddress->where('id', $request->input('address'))->first();
                // dd($dataAddress, $request->input('address'), $address);
            } else {
                $address = $dataAddress->where('is_default', 1)->first();
                // dd($dataAddress, $address);
            }
            session()->put('checkoutItem', $this->checkoutService->getCartItems($request->input('selected_items', [])));
            // dd($address);
            $dataCart = session()->get('checkoutItem');

            // dd($dataCart);
        } else {
            $dataAddress = [];
            $address = '';
            $dataCart = session('checkoutItem', []);
        }
        // dd(session('checkoutItem'));
        return view('client.checkout', compact('dataAddress', 'dataCart', 'address'));

    }

    public function buyNow(Request $request)
    {
        if (Auth::check()) {
            $dataAddress = $this->checkoutService->getAddresses();
            if ($request->has('address')) {
                $address = $dataAddress->where('id', $request->input('address'))->first();
            } else {
                $address = $dataAddress->where('is_default', 1)->first();
            }
        } else {
            $dataAddress = [];
            $address = '';
        }
        $productVariantId = $request['product_variant_id'];
        $quantity = $request['quantity'];
        $dataCart = $this->checkoutService->buyNow($productVariantId, $quantity);

        return view('client.checkout', compact('dataAddress', 'dataCart', 'address'));
    }

    public function storeCheckout(Request $request)
    {
        // dd($request);
        $order = new Order();
        $order->user_id = auth()->id();
        $order->customer_name = $request->input('customer_name');
        $order->session_id = time();
        $order->customer_email = $request->input('customer_email');
        $order->customer_phone = $request->input('customer_phone');
        $order->address_line1 = $request->input('address_line1');
        $order->city = $request->input('city');
        $order->district = $request->input('district');
        $order->ward = $request->input('ward');
        $order->address_line1 = $request->input('address_line1');
        $order->address_line1 = $request->input('address_line1');
        $order->total_price = $request->input('total_price');
        $order->payment_method = $request->input('payment_method');
        $order->save();

        // dd($request->input('cartItem'));
        // Lưu các sản phẩm vào bảng 'order_items'
        $products = json_decode($request->input('cartItem'));
        // dd($products);
        if (is_array($products) || is_object($products)) {
            foreach ($products as $product) {
                $prd = ProductVariant::find($product->product_variant_id);
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_variant_id = $product->product_variant_id;
                $orderItem->product_name = $product->product_name;
                $orderItem->quantity = $product->quantity;
                $orderItem->variant_image = $product->image;
                $orderItem->variant_price_sale = $product->price;
                $orderItem->variant_price_regular = $prd->price_regular;
                $orderItem->variant_sku = $prd->sku;
                $orderItem->product_sku = $prd->product->sku;
                $orderItem->save();
            }
        } else {
            // Trường hợp biến không phải là mảng hoặc đối tượng, xử lý lỗi hoặc thông báo
            echo "Dữ liệu không hợp lệ";
        }

        // Kiểm tra phương thức thanh toán
        if ($request->payment_method == 'COD') {
            return view('client.order-success', compact('products', 'order'))->with('success', 'Đơn hàng của bạn đã được tạo thành công. Vui lòng chờ xác nhận.');
        } else {
            // Nếu là THANH_TOAN_ONLINE, chuyển hướng đến VNPay để thanh toán
            return redirect()->route('vnpay.payment', ['order_id' => $order->id]);
        }
    }
}
