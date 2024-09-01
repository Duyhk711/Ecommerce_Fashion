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
Route::view('/home', 'client.home');
Route::view('/shop', 'client.shop');
Route::view('/empty', 'client.empty');
Route::view('/checkout', 'client.checkout');
Route::view('/order-success', 'client.order-success');
Route::view('/wishlist', 'client.wishlist');
Route::view('/empty', 'client.empty');
Route::view('/cart', 'client.cart');
Route::view('/product-detail', 'client.product-detail');
Route::view('/login', 'client.login');
Route::view('/forgot-password', 'client.forgot-password');
Route::view('/myaccount', 'client.my-account');
