<?php

use App\Http\Controllers\Admin\AdminChatController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\ThongkeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChatsController;
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

        Route::middleware('checkAdmin')->group(function () {

            Route::view('dashboard', 'dashboard')->name('dashboard');

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
            Route::get('/get-attributes', [ProductController::class, 'getAttributes']); //lấy danh sách các thuộc tính
            Route::get('/get-attribute-values/{attributeId}', [ProductController::class, 'getAttributeValues']); //lấy giá trị thuộc tính theo ID của thuộc tính
            Route::get('/get-product-attributes/{productId}', [ProductController::class, 'getProductAttributes']);
            Route::get('/get-product-attributes/{productId}', [ProductController::class, 'getProductAttributes']);
            Route::get('/variants/{id}/edit', [ProductVariantController::class, 'edit']);
            Route::put('/variants/{id}', [ProductVariantController::class, 'update']);
            Route::delete('/variants/{id}', [ProductVariantController::class, 'destroy'])->name('variants.destroy');
            Route::post('/products/variant/update', [ProductController::class, 'updateVariant'])->name('products.variant.update'); //chinh sú hang loat
            Route::patch('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

            // ORDER
            Route::resource('orders', OrderController::class);
            Route::get('orders/{id}', [OrderController::class, 'show'])->name('order.show');
            Route::put('orders/update/{id}', [OrderController::class, 'update'])->name('order.update');

            // USER
            Route::resource('users', UserController::class);
            Route::post('/user/{user}/active', [UserController::class, 'active'])->name('users.active');
            Route::get('clients', [UserController::class, 'getAllClient'])->name('users.clients');
            Route::get('staffs', [UserController::class, 'getAllStaff'])->name('users.staffs');
            Route::get('staffs/create', [UserController::class, 'createStaff'])->name('users.staffs.create');
            Route::post('staffs/store', [UserController::class, 'storeStaff'])->name('users.staffs.store');
            Route::get('staffs/{user}/edit', [UserController::class, 'editStaff'])->name('users.staffs.edit');
            Route::put('staffs/{user}/update', [UserController::class, 'updateStaff'])->name('users.staffs.update');
            Route::post('/user/{user}/active', [UserController::class, 'active'])->name('users.active');

            // Role
            Route::get('roles', [UserController::class, 'getAllRole'])->name('users.roles');
            Route::post('roles/store', [UserController::class, 'storeRole'])->name('users.roles.store');
            Route::get('roles/{role}/edit', [UserController::class, 'editRole'])->name('users.roles.edit');
            Route::get('roles/{role}/permission', [UserController::class, 'getAllPermissionRole'])->name('users.roles.permission');
            Route::post('roles/{role}/permission/update', [UserController::class, 'updatePermissionRole'])->name('users.roles.permission.update');
            Route::post('roles/{role}/update', [UserController::class, 'updateRole'])->name('users.roles.update');
            Route::delete('roles/{role}/delete', [UserController::class, 'deleteRole'])->name('users.roles.delete');
            // Route::view('/users/show', 'admin.users.show')->name('users.show');

            // profile
            Route::view('/profile', 'admin.auth.account-profile')->name('account-profile');
            Route::post('/profile', [AuthenticationController::class, 'updateProfile'])->name('update-profile');
            Route::post('/profile/update-password', [AuthenticationController::class, 'updatePassword'])->name('update-password');

            // BANNER
            Route::resource('banners', BannerController::class);
            Route::post('banners/{banner}/activate', [BannerController::class, 'activate'])->name('banners.activate');

            // VOUCHER
            Route::resource('vouchers', VoucherController::class);
            Route::post('vouchers/{voucher}/activate', [VoucherController::class, 'toggleActive'])->name('vouchers.activate');
            Route::post('vouchers/{voucher}/deactivate', [VoucherController::class, 'toggleDeactive'])->name('vouchers.deactivate');
            //COMMENT
            Route::resource('/comments', CommentController::class);
            Route::get('admin/comments/{id}', [CommentController::class, 'show']);

            //MESSAGE
            Route::get('/list-sessions', [AdminChatController::class, 'listSessions']);
            Route::get('/sessions/{sessionId}/messages', [AdminChatController::class, 'getMessages']);
            Route::post('/end-session/{sessionId}', [AdminChatController::class, 'endSession']);
            Route::post('/send-message/{sessionId}', [AdminChatController::class, 'sendMessage']);
            Route::get('/chats', function () {
                return view('admin.chat.chat');
            });
            Route::post('/mark-messages-read/{sessionId}', [AdminChatController::class, 'markMessagesRead']);

            //THONGKE
            Route::resource('/thongkes', ThongkeController::class);
            Route::get('/admin/thongkes', [ThongkeController::class, 'index'])->name('admin.thongkes.index');
        });
    });
