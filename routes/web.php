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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/admin/category','CategoryController');
    Route::resource('/admin/product','ProductController');
    Route::resource('/admin/alldetails','AllDetails');

    Route::get('category/getlist','CategoryController@getCategoryList')->name('category.getlist');
    Route::get('product/getlist','ProductController@getProductList')->name('product.getlist');
    Route::get('alldetails','AllDetails@alldetails')->name('all.getlist');
	Route::get('/logout', function(){
	   Auth::logout();
	   return Redirect::to('login');
	});
});
