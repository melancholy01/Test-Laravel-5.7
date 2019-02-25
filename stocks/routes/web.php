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



Route::any('/productlist', 'ProductController@index');
Route::post('/store', 'ProductController@store');
Route::post('/category', 'ProductController@category');
Route::get('/deletecategory/{id}', 'ProductController@delCategory');
Route::get('/deleteproduct/{id}', 'ProductController@delProduct');

Route::get('/getproduct/{id}', 'ProductController@getProduct');
Route::get('/getcategory/{id}', 'ProductController@getCategory');




Route::get('/getcategorylist', 'ProductController@getCategorylist');
Route::get('/getproductTable', 'ProductController@productDatatable');
Route::get('/getcategoryTable', 'ProductController@categoryDatatable');
Route::any('/imageresize','ProductController@imageResize');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout')->name('logout');
