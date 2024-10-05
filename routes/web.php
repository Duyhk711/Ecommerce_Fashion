<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Client\MyOrderController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\CheckoutController;

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

Route::get('/san-pham/{slug}', [ProductController::class, "getProductDetail"])->name('productDetail');

// order
Route::view('/order-success', 'client.order-success')->name('orderSuccess'); // Thêm tên
Route::view('/wishlist', 'client.wishlist')->name('wishlist'); // Sửa chính tả từ 'whishlist' thành 'wishlist'
Route::view('/empty-cart', 'client.empty')->name('emptyCart'); // Cụ thể hóa cho giỏ hàng rỗng

// cart
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// page
Route::view('/contact', 'client.contact')->name('contact'); 
Route::view('/support', 'client.support')->name('support'); 
Route::view('/barter', 'client.barter')->name('barter');
Route::view('/blog', 'client.blog')->name('blog');

// account
Route::get('/my-account', [UserController::class, 'info'])->name('myaccount');
Route::get('/my-order', [MyOrderController::class, 'myOrders'])->name('my.order');
Route::get('/order-tracking', [UserController::class, 'orderTracking'])->name('order.tracking');
Route::get('/my-wishlist', [UserController::class, 'myWishlist'])->name('my.wishlist');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');

// address
Route::get('/address', [UserController::class, 'address'])->name('address');
Route::post('/address', [UserController::class, 'storeAddress'])->name('addresses.store');
Route::delete('/address/{id}', [UserController::class, 'destroy'])->name('addresses.destroy');
Route::post('/addresses/{id}/default', [UserController::class, 'setDefault'])->name('addresses.setDefault');

//profile
Route::post('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update');

// checkout
Route::get('/checkout', [CheckoutController::class, 'renderCheckout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'storeCheckout'])->name('postCheckout');

// them binh luan
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');


