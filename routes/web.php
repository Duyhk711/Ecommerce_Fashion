<?php


use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\MyOrderController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\VouchersController;


use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\VNPayController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Example Routes

// home
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/filterproduct', [ShopController::class, 'filterShop'])->name('filter');
// Tìm kiếm sản phẩm
Route::get('/search', [HomeController::class, 'search'])->name('search');
// Trang chủ hiển thị 12 sản phẩm
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');


Route::get('/san-pham/{slug}', [ProductController::class, "getProductDetail"])->name('productDetail');
Route::post('/buy-now', [CheckoutController::class, "buyNow"])->name('buyNow');

// order
// Route::view('/order-success', 'client.order-success')->name('orderSuccess'); // Thêm tên
Route::view('/wishlist', 'client.wishlist')->name('wishlist'); // Sửa chính tả từ 'whishlist' thành 'wishlist'
Route::view('/empty-cart', 'client.empty')->name('emptyCart'); // Cụ thể hóa cho giỏ hàng rỗng

// cart
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

// page
Route::view('/contact', 'client.contact')->name('contact');
Route::view('/support', 'client.support')->name('support');
Route::view('/barter', 'client.barter')->name('barter');
Route::view('/blog', 'client.blog')->name('blog');
Route::get('/vouchers', [VouchersController::class, 'index'])->name('vouchers.index');

// account
Route::get('/my-account', [UserController::class, 'info'])->name('myaccount');
Route::get('/my-order', [MyOrderController::class, 'myOrders'])->name('my.order');
Route::get('/order-tracking', [UserController::class, 'orderTracking'])->name('order.tracking');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/voucher', [VouchersController::class, 'voucher'])->name('voucher');

// Route xem chi tiết đơn hàng
Route::get('/my-orders/{id}', [MyOrderController::class, 'show'])->name('orderDetail');
//Route hủy đơn hàng
Route::post('/order/{order_id}/cancel', [MyOrderController::class, 'cancelOrder'])->name('order.cancel');

//sản phẩm yêu thích
Route::middleware('auth')->group(function () {
    Route::get('/my-wishlist', [UserController::class, 'myWishlist'])->name('my.wishlist');
    Route::post('/wishlist/add/{product_id}', [UserController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product_id}', [UserController::class, 'remove'])->name('wishlist.remove');
});

// address
Route::get('/address', [UserController::class, 'address'])->name('address');
Route::post('/address', [UserController::class, 'storeAddress'])->name('addresses.store');
Route::delete('/addresses/{id}', [UserController::class, 'destroy'])->name('addresses.destroy');
Route::post('/addresses/{id}/default', [UserController::class, 'setDefault'])->name('addresses.setDefault');
// Cập nhật địa chỉ
Route::put('/address/{id}', [UserController::class, 'updateAddress'])->name('addresses.update');
// Lấy dữ liệu địa chỉ để chỉnh sửa
Route::get('/address/{id}/edit', [UserController::class, 'editAddress'])->name('addresses.edit');

//profile
Route::post('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update');

//đổi mật khẩu
Route::post('/my-account/update-password', [AuthenticationController::class, 'updatePassword'])->name('update-password');

// checkout
Route::get('/checkout', [CheckoutController::class, 'renderCheckout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'storeCheckout'])->name('postCheckout');
Route::get('/vnpay-payment', [VNPayController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/vnpay-return', [VNPayController::class, 'vnpayReturn'])->name('orderSuccess');

// them binh luan
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::get('/comments/show/{id}', [CommentController::class, 'show'])->name('comment.show');


Route::post('/save-voucher', [VouchersController::class, 'save'])->name('save-voucher'); 


// User chat routes
Route::middleware('auth')->group(function () {
    Route::get('/user/chats', [ChatsController::class, 'userIndex'])->name('user.chats');
    Route::get('/fetch-messages', [ChatsController::class, 'fetchMessagesFromUserToAdmin'])->name('fetch.messagesFromUserToAdmin');
    Route::post('/send-message', [ChatsController::class, 'sendMessageFromUserToAdmin'])->name('sendMessageFromUserToAdmin');
    Route::get('/get-first-admin', [ChatsController::class, 'getFirstAdmin'])->name('getFirstAdmin');
});


