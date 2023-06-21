<?php

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

Route::get('/home',function () {
    return view('client.pages.home');
})->name('client.home');

Route::middleware('isAdmin')->name('admin.')->group(function() {
    Route::get('admin',function () {
        return view('admin.pages.dashboard');
    })->name('dashboard');

    Route::get('product',function () {
        return view('admin.pages.product.list');
    })->name('product');

    Route::get('product/create',function () {
        return view('admin.pages.product.create');
    })->name('product.create');

    Route::get('product_category',function () {
        return view('admin.pages.product_category.list');
    })->name('product_category');

    Route::get('product_category/create',function () {
        return view('admin.pages.product_category.create');
    })->name('product_category.create');
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
