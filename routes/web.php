<?php

use App\Http\Controllers\Client\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/filterproduct', [ShopController::class, 'filterShop'])->name('filter');

Route::view('/product-detail', 'client.product-detail')->name('productDetail'); // Sửa thành product-detail
Route::view('/checkout', 'client.checkout')->name('checkout');
Route::view('/order-success', 'client.order-success')->name('orderSuccess'); // Thêm tên
Route::view('/wishlist', 'client.wishlist')->name('wishlist'); // Sửa chính tả từ 'whishlist' thành 'wishlist'
Route::view('/empty-cart', 'client.empty')->name('emptyCart'); // Cụ thể hóa cho giỏ hàng rỗng
Route::view('/cart', 'client.cart')->name('cart');
Route::view('/login', 'client.login')->name('login');
Route::view('/register', 'client.register')->name('register');
Route::view('/forgot-password', 'client.forgot-password')->name('forgot-password');
Route::view('/my-account', 'client.my-account')->name('myaccount'); // Sửa thành my-account



// Trang chủ hiển thị 12 sản phẩm
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tìm kiếm sản phẩm
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/product-detail/{id}', [ProductController::class, "getProductDetail"])->name('productDetail');
Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.show');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

// Route::get('/cart', [CartController::class, 'viewCart'])->name('client.cart');
Route::view('/contact', 'client.contact')->name('contact'); 
Route::view('/support', 'client.support')->name('support'); 
Route::view('/barter', 'client.barter')->name('barter');
Route::view('/blog', 'client.blog')->name('blog');

