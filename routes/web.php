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
    });

});


// not admin
Route::get('/not-admin', function () {
    return view('not-admin');
})->middleware(['auth', 'notAdmin']);
