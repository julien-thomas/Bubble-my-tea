<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

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

Route::get('/', function () {
    return view('bubblemytea');
});

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('show');
Route::get('/create', [ProductController::class, 'create'])->name('products.create');
Route::post('create', [ProductController::class, 'store']);
Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
Route::put('products/update/{product}', [ProductController::class, 'update'])->name('products.update');
Route::get('/my_orders', [OrderController::class, 'index'])->name('my_orders');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/add', function() {
    if (! Gate::allows('access-admin')) {
        //abort(403);
        return 'Access denied';
    }
    return view('products.create');
});

Route::get('/edit', function() {
    if (! Gate::allows('access-admin')) {
        //abort(403);
        return 'Access denied';
    }
    return view('products.edit');
});

Route::get('cart', [CartController::class, 'show'])->name('cart.show');
Route::post('cart/store/{product}', [CartController::class, 'store'])->name('cart.store');
Route::get('cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('cart/empty', [CartController::class, 'empty'])->name('cart.empty');

Route::get('store', [OrderController::class, 'store'])->name('order.store');

Route::get('store', [OrderDetailsController::class, 'store'])->name('orderDetails.store');
Route::get('orders/show/{id}', [OrderDetailsController::class, 'show'])->name('orders.show');
Route::get('orders/index/{id}', [OrderDetailsController::class, 'index'])->name('orders.index');
Route::get('orders/showOrders', [OrderDetailsController::class, 'showOrders'])->name('orders.showOrders');


require __DIR__.'/auth.php';
