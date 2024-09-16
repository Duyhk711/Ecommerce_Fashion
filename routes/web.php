<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProductController;

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
Route::view('/home', 'client.home')->name('home');
Route::view('/shop', 'client.shop')->name('shop');
Route::view('/product-detail', 'client.product-detail')->name('productDetail'); // Sửa thành product-detail
Route::view('/checkout', 'client.checkout')->name('checkout');
Route::view('/order-success', 'client.order-success')->name('orderSuccess'); // Thêm tên
Route::view('/wishlist', 'client.wishlist')->name('wishlist'); // Sửa chính tả từ 'whishlist' thành 'wishlist'
Route::view('/empty-cart', 'client.empty')->name('emptyCart'); // Cụ thể hóa cho giỏ hàng rỗng
// Route::view('/cart', 'client.cart')->name('cart');
Route::view('/login', 'client.login')->name('login');
Route::view('/register', 'client.register')->name('register');
Route::view('/forgot-password', 'client.forgot-password')->name('forgot-password');
Route::view('/my-account', 'client.my-account')->name('myaccount'); // Sửa thành my-account

Route::get('/product-detail/{id}', [ProductController::class, "getProductDetail"])->name('productDetail');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
