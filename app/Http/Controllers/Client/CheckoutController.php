<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Order;
use App\Models\CartItem;
use App\Events\TestEvent;
use App\Models\OrderItem;
use App\Events\CreateOrder;
use App\Events\NewOrderNotifyAdmin;
use App\Models\UserVoucher;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Notifications\CreateProduct;
use App\Services\Client\CartService;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CreateNewOrder;
use App\Services\Client\CheckoutService;
use App\Notifications\OrderStatusUpdated;

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

            // dd($dataCart);
        } else {
            $dataAddress = [];
            $address = '';
            // dd($dataCart);
        }
        if ($request->has('selected_items')) {

            session()->put('checkoutItem', $this->checkoutService->getCartItems($request->input('selected_items', [])));
        }
        $dataCart = session('checkoutItem', []);
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
        session()->put('checkoutItem', $this->checkoutService->buyNow($productVariantId, $quantity));
        $dataCart = session('checkoutItem', []);

        return view('client.checkout', compact('dataAddress', 'dataCart', 'address'));
    }

    public function storeCheckout(Request $request)
    {

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            // 'customer_phone' => 'required|regex:/^(\+84|0)[3|5|7|8|9][0-9]{8}$/',
            'customer_phone' => 'required',
            'customer_email' => 'required|email',
            'address_line1' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'ward' => 'required|string|max:100',
        ], [
            'customer_name.required' => 'Họ và tên là bắt buộc.',
            'customer_phone.required' => 'Số điện thoại là bắt buộc.',
            'customer_email.required' => 'Email là bắt buộc.',
            'customer_email.email' => 'Email sai định dạng.',
            // 'customer_phone.regex' => 'Số điện thoại không đúng định dạng.',
            'address_line1.required' => 'Địa chỉ là bắt buộc.',
            'city.required' => 'Tỉnh/Thành phố là bắt buộc.',
            'district.required' => 'Quận/Huyện là bắt buộc.',
            'ward.required' => 'Phường/Xã là bắt buộc.',
        ]);

        DB::beginTransaction(); // Bắt đầu transaction

        try {
            $products = json_decode($request->input('cartItem'));

            // dd($request->all());
            $order = new Order();
            $order->user_id = Auth::check() ? auth()->id() : null;
            $order->customer_name = $request->input('customer_name');
            $order->session_id = 'ORD' . time();
            $order->sku = $order->session_id;
            $order->customer_email = $request->input('customer_email');
            $order->customer_phone = $request->input('customer_phone');
            $order->address_line1 = $request->input('address_line1');
            $order->city = $request->input('city');
            $order->district = $request->input('district');
            $order->ward = $request->input('ward');
            $order->note = $request->input('note');
            $order->address_line1 = $request->input('address_line1');
            $order->address_line1 = $request->input('address_line1');
            $order->total_price = $request->input('total_price');
            $order->payment_method = $request->input('payment_method');
            $order->discount = $request->input('discount');
            $order->voucher_id = $request->input('voucher_id');
            $order->save();
            if (Auth::check()) {
                $userVoucher = UserVoucher::where('user_id', auth()->id())
                    ->where('voucher_id', $request->input('voucher_id'))
                    ->lockForUpdate()
                    ->first(); // Lấy bản ghi đầu tiên (chỉ có một)

                if ($userVoucher) {
                    $userVoucher->is_used = 1; // Cập nhật giá trị
                    $userVoucher->save(); // Lưu vào cơ sở dữ liệu
                }
            }
            // dd($order->customer_email);
            $this->checkoutService->sendOrderConfirmationNotification($order);
            // Mail::to($order->customer_email)->send(new OrderConfirmation($order));

            // dd($request->input('cartItem'));
            // Lưu các sản phẩm vào bảng 'order_items'
            // dd($products);
            if (is_array($products) || is_object($products)) {
                $cartItems = [];
                foreach ($products as $product) {
                    $prd = ProductVariant::where('id', $product->product_variant_id)
                        ->lockForUpdate() // Khóa sản phẩm để giảm số lượng
                        ->first();

                    if (!$prd || $prd->stock < $product->quantity) {
                        // Nếu không đủ hàng, hủy bỏ transaction và chuyển hướng về trang chủ
                        DB::rollBack();

                        return redirect()->route('home')
                            ->withErrors(["error" => "Sản phẩm {$product->product_name} không đủ hàng."]);
                    }
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

                    $prd->stock -= $product->quantity;
                    $prd->save();
                    if (Auth::check()) {
                        CartItem::where('id', $product->cart_item_id)->forceDelete();
                    } else {
                        $cartItems = session('cart', []);
                        unset($cartItems[$product->product_variant_id]);
                        // dd($cartItems);
                        // dd(session('cart'));
                    }
                    session()->put('cart', $cartItems);
                }

                $orderItems = OrderItem::with([
                    'productVariant.variantAttributes.attribute',
                    'productVariant.variantAttributes.attributeValue',
                ])->where('order_id', $order->id)
                    ->get();

                $orderItems = $orderItems->map(function ($orderItem) {
                    $variant = $orderItem->productVariant;

                    // Xử lý thuộc tính biến thể sản phẩm
                    $attributes = $variant->variantAttributes->map(function ($variantAttribute) {
                        return $variantAttribute->attribute->name . ': ' . $variantAttribute->attributeValue->value;
                    })->implode(', ');

                    return [
                        'product_name' => $orderItem->product_name,
                        'product_variant_id' => $orderItem->product_variant_id,
                        'variant_attributes' => $attributes,
                        'image' => $orderItem->variant_image,
                        'price' => $orderItem->variant_price_sale,
                        'quantity' => $orderItem->quantity,
                    ];
                });
            } else {
                // Trường hợp biến không phải là mảng hoặc đối tượng, xử lý lỗi hoặc thông báo
                echo "Dữ liệu không hợp lệ";
            }
            if ($order->user_id) {
                $user = $order->user;
                $message = "Đơn hàng <strong>{$order->sku}</strong> đã được đặt thành công, đang chờ xác nhận từ cửa hàng.";
                $title = "Cập nhật đơn hàng";
                $user->notify(new OrderStatusUpdated($order, $message, $title));
            }
            $users = User::all();
            foreach ($users as $userNotify) {
                $userNotify->notify(new CreateNewOrder($order, 'Çó đơn hàng mới!', $title));
            }
            broadcast(new NewOrderNotifyAdmin($order));
            Log::info('Broadcasting CreateOrder event for order: ', ['order' => $order]);
            // Commit transaction nếu không có lỗi
            DB::commit();
            // Kiểm tra phương thức thanh toán
            if ($request->payment_method == 'COD') {
                // dd($product);
                return view('client.order-success', compact('orderItems', 'order'))->with('success', 'Đơn hàng của bạn đã được tạo thành công. Vui lòng chờ xác nhận.');
            } else {
                return redirect()->route('vnpay.payment', ['order_id' => $order->id]);
            }
        } catch (\Exception $e) {
            DB::rollBack(); // Hoàn tác nếu xảy ra lỗi
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function orderPayment($id)
    {
        return redirect()->route('vnpay.payment', ['order_id' => $id]);
    }

}
