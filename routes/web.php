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

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::group(['prefix' => '/', 'middleware' => 'auth'],function () {
    // Route::get('/', function () {
    //     return view('backend.dashboard');
    // })->name('home');
    // Route::get('/home', function () {
    //     return view('backend.dashboard');
    // })->name('home');

    // Route::get('/logout', function () {
    //     Auth::logout();
    //     return redirect('/');
    // })->name('logout');

    // // Category
    // Route::resource('category', 'CategoryController')->except(['show', 'update', 'delete']);
    // Route::prefix('category')->group(function () {
    //     Route::post('update-category/{id}', 'CategoryController@update')->name('category.update');
    //     Route::get('delete-category/{category}', 'CategoryController@destroy')->name('category.destroy');
    // });

    // // Product
    // Route::resource('product', 'ProductController')->except(['update', 'delete']);
    // Route::prefix('product')->group(function () {
    //     Route::post('update-product/{product}', 'ProductController@update')->name('product.update');
    //     Route::get('delete-product/{product}', 'ProductController@destroy')->name('product.destroy');
    // });
//});

// Auth::routes();
