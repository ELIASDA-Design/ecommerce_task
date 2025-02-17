<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'show'])->name("home");

/**General user routes **/
Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'generalUserDashboard'])->name('dashboard');

    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('add-cart');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('remove-cart');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('update-cart');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('checkout-cart');
    Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('clear-cart');
});

/**Admin routes **/
Route::middleware('adminAuth')->prefix('admin/dashboard')->group(function(){
    Route::get('/', [DashboardController::class, 'adminDashboard'])->name('adminDashboardShow');
    /*
     *                      Products CRUD
     * */
    Route::get('/products', [ProductsController::class, 'show'])->name('show-products');
    Route::get('/products/add', [ProductsController::class, 'showAddPage'])->name('add-product');
    Route::post('/products/add', [ProductsController::class, 'create'])->name('post-add-product');
    Route::get('/products/edit/{id}', [ProductsController::class, 'showEditPage'])->name('edit-product');
    Route::post('/products/edit', [ProductsController::class, 'edit'])->name('post-edit-product');
    Route::post('/products/delete', [ProductsController::class, 'delete'])->name('delete-product');

    /*
     *                  Orders CRUD
     *
     * */
    Route::get('/orders', [OrdersController::class, 'show'])->name('show-orders');
    Route::get('/orders/add', [OrdersController::class, 'showAddPage'])->name('add-order');
    Route::post('/orders/add', [OrdersController::class, 'create'])->name('post-add-order');
    Route::get('/orders/edit/{id}', [OrdersController::class, 'showEditPage'])->name('edit-order');
    Route::post('/orders/edit', [OrdersController::class, 'edit'])->name('post-edit-order');
    Route::post('/orders/delete', [OrdersController::class, 'delete'])->name('delete-order');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
