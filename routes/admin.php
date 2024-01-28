<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('dashboard.settings.index');
})->name('index');
*/

Route::get('/index', [App\Http\Controllers\Dashboard\IndexController::class, 'index'])->name('admin');


Route::controller(App\Http\Controllers\Dashboard\CategoryController::class)->group(function () {
    Route::get('/category', 'index');
    Route::get('/category/create', 'create');
    Route::post('/category', 'store');
    Route::get('/category/{category}/edit', 'edit');
    Route::put('/category/{category}', 'update');
});

Route::controller(App\Http\Controllers\Dashboard\ProductController::class)->group(function () {
    Route::get('/product', 'index');
    Route::get('/product/create', 'create');
    Route::post('/product', 'store');
    Route::get('/product/{product_id}/edit', 'edit');
    Route::put('/product/{product_id}', 'update');
    Route::get('/product-image/{product_image_id}/delete', 'destroyImage');
    Route::get('/product/{product_id}/delete', 'destroy');
    Route::post('product_color/{product_color_id}', 'updateProductColorQty');
    Route::get('product_color/{product_color_id}/delete', 'destroyProductColor');
});

Route::controller(App\Http\Controllers\Dashboard\ColorController::class)->group(function () {
    Route::get('/color', 'index');
    Route::get('/color/create', 'create');
    Route::post('/color', 'store');
    Route::get('/color/{color_id}/edit', 'edit');
    Route::put('/color/{color_id}', 'update');
    Route::get('/color/{color_id}/delete', 'destroy');
});

Route::controller(App\Http\Controllers\Dashboard\OrderController::class)->group(function () {
    Route::get('/order', 'index');
    Route::get('/order/{order_id}/edit', 'edit');
    Route::put('/order/{order_id}', 'update');
    Route::get('/invoice/{order_id}/generate', 'generateInvoice');
    Route::get('/invoice/{order_id}/email', 'emailInvoice');
    Route::get('/invoice/{order_id}', 'viewInvoice');
});

Route::controller(App\Http\Controllers\Dashboard\SliderController::class)->group(function () {
    Route::get('/slider', 'index');
    Route::get('/slider/create', 'create');
    Route::post('/slider', 'store');
    Route::get('/slider/{slider_id}/edit', 'edit');
    Route::put('/slider/{slider_id}', 'update');
    Route::get('/slider/{slider_id}/delete', 'destroy');
});


