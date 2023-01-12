<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

Route::get('/categories', [CategoryController::class, 'index'])->name('categoriesIndex');
Route::post('/categories_add', [CategoryController::class, 'store'])->name('addCategory');
Route::get('/categories_delete/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');

Route::get('/products', [ProductController::class, 'index'])->name('productsIndex');
Route::get('/products_create', [ProductController::class, 'create'])->name('productsCreate');
Route::post('/products_add', [ProductController::class, 'store'])->name('addProduct');
Route::get('/product_detail/{id}', [ProductController::class, 'show'])->name('productDetail');
Route::get('/products_delete/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');
Route::get('/product_edit/{id}', [ProductController::class, 'edit'])->name('editProduct');
Route::post('/products_update/{id}', [ProductController::class, 'update'])->name('updateProduct');

Route::get('/my_cart', [CartController::class, 'index'])->name('myCart');
Route::post('/add_to_cart/{id}', [CartController::class, 'store'])->name('addToCart');
Route::get('/cart_product_delete/{id}', [CartController::class, 'destroy'])->name('deleteProductFromCart');

Route::get('/checkout', [OrderController::class, 'cartToOrder'])->name('checkout');
Route::get('/orders', [OrderController::class, 'index'])->name('ordersIndex');
Route::get('/deliver/{id}', [OrderController::class, 'deliver'])->name('orderDeliver');
Route::get('/order_delete/{id}', [OrderController::class, 'destroy'])->name('deleteOrder');
