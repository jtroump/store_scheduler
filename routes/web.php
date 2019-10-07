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

Route::get('stores', 'StoreController@stores');
Route::get('api/stores', 'StoreController@get_all_stores');
Route::post('api/save/stores', 'StoreController@save_stores');
