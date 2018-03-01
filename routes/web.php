<?php

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

Route::group(['prefix' => 'api', 'namespace' => 'Api', 'middleware'=>'api'], function () {
	
	Route::get('/products', 'ProductController@index')->name('products');
	
	Route::delete('/cart/{product_id}', 'CartController@delete')->name('cart.delete');
	Route::post('/cart', 'CartController@add')->name('cart.add');
	
	Route::get('/cart/{product_id}/delete', 'CartController@delete')->name('cart.getDelete');
	Route::get('/cart/{product_id}/{quantity}', 'CartController@add')->name('cart.getAdd');
	
	
	Route::get('/cart', 'CartController@index')->name('cart');
});

Route::get('/', function () {
    return view('welcome');
});
