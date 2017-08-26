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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/getSupplier', 'HomeController@getAllSupplier');
Route::get('/getProduk/{id}', 'HomeController@getProduk');
Route::post('/addList', 'HomeController@addList');
Route::post('/updateList/{id}', 'HomeController@updateList');
Route::get('/editList/{id}', 'HomeController@editList');
Route::post('/deleteList/{id}', 'HomeController@deleteList');
