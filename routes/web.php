<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */


Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', function () {
  if (auth()->check()) {
    return redirect()->route('product.index');
  }
  else {
    return view('auth.login');
  }
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
  // Product Routes
  Route::get('/products', [ProductController::class , 'index'])->name('product.index');
  Route::get('/products/{product}', [ProductController::class , 'show'])->name('product.show');
  Route::post('/products/search', [ProductController::class , 'search'])->name('product.search');
  Route::post('/add_to_cart', [ProductController::class , 'addToCart'])->name('product.add.cart');
  // Cart Routes
  Route::get('/cart-list', [ProductController::class , 'cartIndex'])->name('cart.index');
  Route::delete('/cart-list/{id}', [ProductController::class , 'cartDestroy'])->name('cart.destroy');
});


require __DIR__ . '/auth.php';
