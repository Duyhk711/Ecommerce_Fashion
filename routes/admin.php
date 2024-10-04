<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Admin\VoucherController;
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

Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
      
        //AUTH
        Route::get('/login', [AuthenticationController::class, 'loginAdmin'])->name('loginAdmin');
        Route::post('/login', [AuthenticationController::class, 'postAdminLogin'])->name('postAdminLogin');
        Route::post('/logout', [AuthenticationController::class, 'logoutAdmin'])->name('logoutAdmin');
        Route::view('/forgot-password', view: 'admin.auth.forgot-password')->name(name: 'forgot-password');
        Route::post('/forgot-password', [AuthenticationController::class, 'sendOtpAdmin'])->name(name: 'send-otp');
        Route::get('/verify-otp', [AuthenticationController::class, 'showVerifyOtpAdminForm'])->name('verify-otp');
        Route::post('/verify-otp', [AuthenticationController::class, 'verifyOtpAdmin'])->name('verify-otp.post');
        Route::get('/reset-password', [AuthenticationController::class, 'showResetPasswordAdminForm'])->name('reset-password');
        Route::post('/reset-password', [AuthenticationController::class, 'resetPasswordAdmin'])->name('reset-password.post');
      
        // Route::middleware('checkAdmin')->group(function (){
          
        Route::view('dashboard', 'dashboard' )->name('dashboard');
        // ATTRIBUTE
        Route::resource('attributes', AttributeController::class);

        // ATTRIBUTE VALUE
        Route::resource('attribute_values', AttributeValueController::class);

        // CATALOGUES
        Route::resource('catalogues', CatalogueController::class);
        //ACTIVATE
        Route::post('catalogues/{catalogue}/activate', [CatalogueController::class, 'activate'])->name('catalogues.activate');
        Route::post('catalogues/{catalogue}/deactivate', [CatalogueController::class, 'deactivate'])->name('catalogues.deactivate');
        // PRODUCT
        Route::resource('products', ProductController::class);

        // ORDER
        Route::resource('orders', OrderController::class);
        Route::get('orders/{id}', [OrderController::class, 'show'])->name('order.show');

        // USER
        Route::view('users', 'admin.users.index')->name('users.index');
        Route::view('users/show', 'admin.users.show')->name('users.show');
         
        // profile
        Route::view('/profile','admin.auth.account-profile')->name('account-profile');
        Route::post('/profile',[AuthenticationController::class,'updateProfile'])->name('update-profile');
        Route::post('/profile/update-password', [AuthenticationController::class, 'updatePassword'])->name('update-password');
      
        // BANNER
        Route::resource('banners', BannerController::class);
        Route::post('banners/{banner}/activate', [BannerController::class, 'activate'])->name('banners.activate');
        
        // VOUCHER
        Route::resource('vouchers', VoucherController::class);
     
    });
// });
