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


Route::get('/test', 'TestController@index')->name('test');

Route::get('/account', 'AccountController@index')->name('account');
Route::get('/account/create', 'AccountController@create')->name('account_create');
Route::post('/account/create_proses','AccountController@create_proses');
Route::get('/account/delete/{id}', 'AccountController@delete');
Route::get('/account/update/{id}', 'AccountController@update');
Route::post('/account/update_proses','AccountController@update_proses');

Route::get('/data', 'DataController@index')->name('data');
Route::get('/data/create', 'DataController@create')->name('data_create');
Route::post('/data/create_proses','DataController@create_proses');
Route::get('/data/delete/{nama_file}', 'DataController@delete');
Route::get('/data/detail/{nama_file}', 'DataController@detail');
Route::get('/data/update/{nama_file}', 'DataController@update');
Route::post('/data/update_proses','DataController@update_proses');

