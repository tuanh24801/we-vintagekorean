<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\Client\HomeController::class,'index'])->name('home');
Route::post('/', [App\Http\Controllers\Client\HomeController::class,'index']);
Route::get('/products', [App\Http\Controllers\Client\ProductController::class,'index']);
Route::post('/products/addCart/{product_id}', [App\Http\Controllers\Client\ProductController::class,'addCart']);
Route::get('/products/destroyCart', [App\Http\Controllers\Client\ProductController::class,'destroyCart']);
Route::get('/products/updateCart/{rowId}/{qty}', [App\Http\Controllers\Client\ProductController::class,'updateCart']);
Route::get('/cart', [App\Http\Controllers\Client\CartController::class,'index']);
Route::get('/cart/{rowId}', [App\Http\Controllers\Client\CartController::class,'deleteItem']);


Route::prefix('we-admin')->group(function () {
    Auth::routes();
});


Route::prefix('we-admin')->middleware(['auth', 'isAdmin'])->name('admin.')->group(function (){
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    });

    // Account controller
    Route::controller(App\Http\Controllers\Admin\AccountController::class)->group( function(){
        Route::get('/accounts', 'index');
    });

    // Color Controller
    Route::controller(App\Http\Controllers\Admin\ColorController::class)->group( function(){
        Route::get('/colors', 'index');
    });

    // Product Controller
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group( function(){
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::patch('/products/{product}', 'update');
    });

});


// not admin
Route::get('/not-admin', function () {
    return view('not-admin');
})->middleware(['auth', 'notAdmin']);
