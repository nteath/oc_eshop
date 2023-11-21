<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\CartsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\CartItemsController;
use App\Http\Controllers\Api\Auth\LoginController;


/*
 |--------------------------------------------------------------------------
 | AUTH
 |--------------------------------------------------------------------------
 */
Route::middleware('guest')->group(function() {
    Route::post('login', [LoginController::class, 'login'])->name('auth.login');
});


Route::middleware('auth:api')->group(function() {
    Route::get('users/me', [UsersController::class, 'show'])->name('users.me');
    Route::post('logout',  [LoginController::class, 'logout'])->name('auth.logout');
});


/*
 |--------------------------------------------------------------------------
 | ESHOP / PRODUCTS
 |--------------------------------------------------------------------------
 */
Route::get('products',        [ProductsController::class, 'index'])->name('products.index');
Route::get('products/{uuid}', [ProductsController::class, 'show'])->name('products.show');

/*
 |--------------------------------------------------------------------------
 | ADD TO CART
 |--------------------------------------------------------------------------
 */
Route::post('cart-items',     [CartItemsController::class, 'store'])->name('cart-items.store');


/*
 |--------------------------------------------------------------------------
 | CART
 |--------------------------------------------------------------------------
 */
Route::get('carts/{uuid}',    [CartsController::class, 'show'])->name('carts.show');
Route::post('carts/discount', [CartsController::class, 'applyDiscount'])->name('carts.discount');


/*
 |--------------------------------------------------------------------------
 | CHECKOUT
 |--------------------------------------------------------------------------
 */
Route::post('checkout',       [OrdersController::class, 'store'])->name('checkout');
