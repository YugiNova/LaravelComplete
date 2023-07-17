<?php

use App\Http\Controllers\Client\CartController;
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


//Cart
Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/',[CartController::class,'showCart'])->name('showCart');
    Route::get('/product/add-to-cart/{product}/{qty?}',[CartController::class,'addProductToCart'])->name('addToCart');
    Route::get('/product/add-to-cart/{product}',[CartController::class,'deleteProductToCart'])->name('deleteCartItem');
})

?>