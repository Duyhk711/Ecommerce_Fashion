<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ShopController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/filterproduct', [ShopController::class, 'filterShop'])->name('filter');

Route::view('/product-detail', 'client.product-detail')->name('productDetail'); // Sửa thành product-detail
Route::view('/checkout', 'client.checkout')->name('checkout');
Route::view('/order-success', 'client.order-success')->name('orderSuccess'); // Thêm tên
Route::view('/wishlist', 'client.wishlist')->name('wishlist'); // Sửa chính tả từ 'whishlist' thành 'wishlist'
Route::view('/empty-cart', 'client.empty')->name('emptyCart'); // Cụ thể hóa cho giỏ hàng rỗng
Route::view('/my-account', 'client.my-account')->name('myaccount'); // Sửa thành my-account

Route::get('/product-detail/{id}', [ProductController::class, "getProductDetail"])->name('productDetail');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::view('/contact', 'client.contact')->name('contact'); 
Route::view('/support', 'client.support')->name('support'); 
Route::view('/barter', 'client.barter')->name('barter');
Route::view('/blog', 'client.blog')->name('blog');
