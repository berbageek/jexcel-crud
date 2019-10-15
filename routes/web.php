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

Route::get('mobil', 'MobilController@index')->name('mobil.index');
Route::get('mobil/create', 'MobilController@create')->name('mobil.create');
Route::post('mobil', 'MobilController@store')->name('mobil.store');
