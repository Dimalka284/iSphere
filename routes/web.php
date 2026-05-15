<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;


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

Route::get('/', [CategoryController::class,'index']); 
Route::get('/phone',[ProductController::class,'index']);
Route::get('/mac',[ProductController::class,'mac']);
Route::get('/product/{id}',[ProductController::class,'show'])->name('product.show');


//Password = password123
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/products', [AdminController::class, 'index']);
    Route::get('/products/create', [AdminController::class, 'create']);
    Route::post('/products', [AdminController::class, 'store']);
    Route::get('/products/{id}/edit', [AdminController::class, 'edit']);
    Route::put('/products/{id}', [AdminController::class, 'update']);
    Route::delete('/products/{id}', [AdminController::class, 'destroy']);
    Route::get('/order', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
});

    
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/buy-now/{product}', [CartController::class, 'buyNow'])->name('cart.buyNow');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/{product}', [StripeController::class, 'checkout'])->name('checkout');
    Route::get('/success', [StripeController::class, 'success'])->name('success');
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);