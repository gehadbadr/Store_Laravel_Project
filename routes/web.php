<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaypalController;


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
    return view('welcome');
})->name('index');
*/
Auth::routes();


Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [HomeController::class, 'categories']);
Route::get('/collection/{category_slug}/', [HomeController::class, 'pcat']);
Route::get('/collection/{category_slug}/{product_slug}/', [HomeController::class, 'product']);

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [UserController::class, 'wishlist']);
    Route::get('/cart', [UserController::class, 'cart']);
    Route::get('/checkout', [UserController::class, 'checkout']);
    Route::get('/order', [UserController::class, 'order']);
    Route::get('/order/{order_id}/', [UserController::class, 'orderView']);


    /*PayPal*/
    Route::post('/paypal/payment', [PaypalController::class, 'payment']);
    Route::get('/paypal/success', [PaypalController::class, 'success']);
    Route::get('/paypal/cancel', [PaypalController::class, 'cancel']);

});

Route::get('/thank-you', [HomeController::class, 'thankyou']);


/*
Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index');
    Route::get('/categories', 'categories');
    Route::get('/category/{category_slug}/', 'pcat');
    Route::get('/product/{product_id}', 'product');
   /* Route::get('/product/{product_id}/delete', 'destroy');
    Route::post('product_color/{product_color_id}', 'updateProductColorQty');
    Route::get('product_color/{product_color_id}/delete', 'destroyProductColor');
});
*/



//Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
