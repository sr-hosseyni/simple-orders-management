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

Route::resource('order', 'OrderController');

//Route::get('order', 'OrderController@index');
//Route::get('order/edit', 'OrderController@edit');
//Route::post('order/update', 'OrderController@update');
//Route::get('order/delete', 'OrderController@destroy');
