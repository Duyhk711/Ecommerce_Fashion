<?php

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
Route::view('/home', 'client.home')->name('pages.home');
Route::view('/shop', 'client.shop')->name('pages.shop');
Route::view('/product', 'client.product-detail')->name('pages.productDetail');
Route::view('/empty', 'client.empty')->name('pages.empty');
Route::view('/checkout', 'client.checkout')->name('pages.checkout');
Route::view('/order-success', 'client.order-success')->name('pages.orderSuccess');
Route::view('/wishlist', 'client.wishlist')->name('pages.wishlist');
Route::view('/cart', 'client.cart')->name('pages.cart');
Route::view('/login', 'client.login')->name('pages.login');
Route::view('/forgot-password', 'client.forgot-password')->name('pages.forgotPass');
Route::view('/myaccount', 'client.my-account')->name('pages.myAccount');
