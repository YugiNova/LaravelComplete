<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\DetailController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
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

Route::get('/', function () {
    return view('welcome');
});
//Home page
Route::get('/home',[HomeController::class,'index'])->name('client.home');

//Detail page
Route::get('/product/{slug}',[DetailController::class,'index'])->name('client.product.detail');

//Cart
Route::get('/product/add-to-cart/{product}',[CartController::class,'addProductToCart'])->name('client.product.addToCart');
Route::get('/cart',[CartController::class,'showCart'])->name('client.product.showCart');

Route::middleware('isAdmin')->name('admin.')->group(function() {
    Route::get('admin',function () {
        return view('admin.pages.dashboard');
    })->name('dashboard');

    //Product
    Route::resource('admin/product',ProductController::class);
    Route::post('admin/product/restore/{product}',[ProductController::class,'restore'])->name('product.restore');

    //Product Category
    Route::get('product_category',[ProductCategoryController::class, 'index'])->name('product_category');

    Route::get('product_category/create',function () {
        return view('admin.pages.product_category.create');
    })->name('product_category.create');

    Route::post('product_category/store',[ProductCategoryController::class, 'store'])->name('product_category.store');

    Route::get('product_category/{id}', [ProductCategoryController::class,'detail'])->name('product_category.detail');

    Route::post('product_category/slug',[ProductCategoryController::class, 'getSlug'])->name('product_category.slug');

    Route::post('product_category/{id}', [ProductCategoryController::class,'update'])->name('product_category.update');

    Route::post('product_category/delete/{id}', [ProductCategoryController::class,'destroy'])->name('product_category.delete');
});

// Route::get('/blog',function () {
//     return view('admin.pages.blog');
// })->name('admin.dashboard')->middleware('isAdmin');

Route::get('/cocacola',function () {
    return 'COCACOLA';
})->name('cocacola');

Route::get('/chivas',function () {
    return 'CHIVAS';
})->name('chivas')->middleware('checkAge');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
