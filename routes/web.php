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

Route::resource('groups', 'GroupController');
Route::resource('hosts', 'HostController');
Route::get('/ajax_loadaverage/{id}', 'HostController@ajax_loadaverage');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
