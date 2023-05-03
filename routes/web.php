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

Route::get('/', function () {
    return '<h1>Đây là trang người dùng</h1>';
});


Route::prefix('we-admin')->group(function () {
    Auth::routes();
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::redirect('/home','/');

Route::prefix('we-admin')->middleware(['auth', 'isAdmin'])->name('admin.')->group(function (){
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    });

    // Account controller
    Route::controller(App\Http\Controllers\Admin\AccountController::class)->group( function(){
        Route::get('/accounts', 'index');
        Route::get('/accounts/create', 'create');
        Route::post('/accounts', 'store');
        Route::get('/accounts/{user_id}', 'update');
        Route::delete('/accounts/{user_id}/delete', 'destroy');
    });

    // Product Controller
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group( function(){
        Route::get('/products', 'index');
    });

});


// not admin
Route::get('/not-admin', function () {
    return view('not-admin');
})->middleware(['auth', 'notAdmin']);
