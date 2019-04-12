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
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/register', 'Auth\RegisterController@showRegisterationForm');
Route::post('/login', 'Auth\LoginController@Login');
Route::post('/register', 'Auth\RegisterController@Register');
Route::get('/logout', 'Auth\LoginController@Logout');