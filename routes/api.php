<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', 'AuthController@login')->name('login');
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', 'AuthController@logout');
    Route::apiResource('product', 'ProductController')->only([
        'index', 'show', 'store', 'destroy'
    ]);
    Route::put('/product', 'ProductController@update')->name('product.update');

    Route::apiResource('category', 'CategoryController')->only([
        'index', 'show', 'store', 'destroy'
    ]);
    Route::put('/category', 'CategoryController@update')->name('category.update');

    Route::prefix('order')->group(function () {
        Route::get('/', 'OrderController@index');                           // Show all order
        Route::get('/get-order-by-user', 'OrderController@getOrderUser');   // Show all order theo user_id
        Route::post('/', 'OrderController@store');                          // Create new order
        Route::delete('/', 'OrderController@destroy');                      // Delete order
        Route::get('/{order}', 'OrderController@show');                     // Find order
    });
});