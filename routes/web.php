<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Store\ShopController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CommissionLevelsController;
use App\Http\Controllers\Admin\OrdersController;
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
Route::get('/', [ShopController::class, 'index'])->name('welcome');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/product/{slug}', [ShopController::class, 'product'])->name('product');
Route::post('cart-store', [ShopController::class, 'cartStore'])->name('cart-store');
Route::post('simple-cart-store', [ShopController::class, 'cartStoreSimple'])->name('simple-cart-store');
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::get('/update-cart/{cartItemId}/{newQuantity}', [ShopController::class, 'updateCart'])->name('update.cart');
Route::get('/remove-cart-item/{cartItemId}', [ShopController::class, 'removeCartItem']);
Route::get('checkout',  [ShopController::class, 'checkout'])->name('checkout');


// User routes
Auth::routes(['verify' => true]);

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        Route::post('/editAdminProfile', [DashboardController::class, 'editProfile'])->name('admin.editProfile');
        Route::post('/editAdminPassword', [DashboardController::class, 'editPassword'])->name('admin.editPassword');

        Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users');
        Route::get('/user-view/{id}', [UserManagementController::class, 'view'])->name('admin.user-view');
        Route::post('/user-activate', [UserManagementController::class, 'activate'])->name('admin.user-activate');
        Route::post('/user-deactivate', [UserManagementController::class, 'deactivate'])->name('admin.user-deactivate');
        Route::post('/user-delete', [UserManagementController::class, 'delete'])->name('admin.user-delete');

        Route::get('/products', [ProductsController::class, 'index'])->name('admin.products');
        Route::post('/products-store', [ProductsController::class, 'store'])->name('admin.products-store');
        Route::post('/products-update', [ProductsController::class, 'update'])->name('admin.products-update');
        Route::post('/products-delete', [ProductsController::class, 'delete'])->name('admin.products-delete');

        Route::get('/commission-levels', [CommissionLevelsController::class, 'index'])->name('admin.commission-levels');
        Route::post('/commission-levels-update', [CommissionLevelsController::class, 'update'])->name('admin.commission-levels-update');

        Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders');
        Route::get('/order-details/{order_number}', [OrdersController::class, 'details'])->name('admin.order-details');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::get('/earnings', [App\Http\Controllers\HomeController::class, 'earnings'])->name('earnings');
Route::get('/referrals', [App\Http\Controllers\HomeController::class, 'referrals'])->name('referrals');
Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders');
Route::post('/editProfile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('editProfile');
Route::post('/editPassword', [App\Http\Controllers\HomeController::class, 'editPassword'])->name('editPassword');
Route::get('show-order/{order_number}',  [ShopController::class, 'showOrder'])->name('show.order');
