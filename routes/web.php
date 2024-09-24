<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\UserController;
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
// Route::view('/home', 'client.home')->name('home');
Route::view('/shop', 'client.shop')->name('shop');
Route::view('/product-detail', 'client.product-detail')->name('productDetail'); // Sửa thành product-detail
Route::view('/checkout', 'client.checkout')->name('checkout');
Route::view('/order-success', 'client.order-success')->name('orderSuccess'); // Thêm tên
Route::view('/wishlist', 'client.wishlist')->name('wishlist'); // Sửa chính tả từ 'whishlist' thành 'wishlist'
Route::view('/empty-cart', 'client.empty')->name('emptyCart'); // Cụ thể hóa cho giỏ hàng rỗng
Route::view('/cart', 'client.cart')->name('cart');
// Route::view('/my-account', 'client.my-account')->name('myaccount'); // Sửa thành my-account


// Trang chủ hiển thị 12 sản phẩm
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tìm kiếm sản phẩm
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::get('/my-account', [UserController::class, 'info'])->name('myaccount');
Route::get('/my-order', [UserController::class, 'myOrder'])->name('my.order');
Route::get('/order-tracking', [UserController::class, 'orderTracking'])->name('order.tracking');
Route::get('/my-wishlist', [UserController::class, 'myWishlist'])->name('my.wishlist');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');

//địa chỉ
Route::get('/address', [UserController::class, 'address'])->name('address');
Route::post('/address', [UserController::class, 'storeAddress'])->name('addresses.store');
Route::delete('/address/{id}', [UserController::class, 'destroy'])->name('addresses.destroy');
Route::post('/addresses/{id}/default', [UserController::class, 'setDefault'])->name('addresses.setDefault');

//profile
Route::post('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update');
