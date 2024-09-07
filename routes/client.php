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
Route::view('/home', 'client.home')->name('home');
Route::view('/shop', 'client.shop')->name('shop');
Route::view('/productDetail', 'client.product-detail')->name('productDetail');
Route::view('/checkout', 'client.checkout')->name('checkout');
Route::view('/order-success', 'client.order-success');
Route::view('/wishlist', 'client.wishlist')->name('whishlist');
Route::view('/empty', 'client.empty');
Route::view('/cart', 'client.cart')->name('cart');
Route::view('/login', 'client.login')->name('login');
Route::view('/register', 'client.register')->name('register');
Route::view('/forgot-password', 'client.forgot-password')->name('forgot-password');
Route::view('/myaccount', 'client.my-account')->name('myaccount');
