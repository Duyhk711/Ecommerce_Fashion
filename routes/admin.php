<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
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

// Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        // ATTRIBUTE
        Route::resource('attributes', AttributeController::class);

        // ATTRIBUTE VALUE
        Route::resource('attribute_values', AttributeValueController::class);

        // CATALOGUES
        Route::resource('catalogues', CatalogueController::class);

        // PRODUCT
        Route::resource('products', ProductController::class);

        // ORDER
        Route::resource('orders', OrderController::class);
        Route::view('order/show', 'admin.orders.show')->name('order.show');

        // USER
        Route::view('users', 'admin.users.index')->name('users.index');
        Route::view('users/show', 'admin.users.show')->name('users.show');
    });
