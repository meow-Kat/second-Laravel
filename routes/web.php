<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// Auth::routes();

// 在Gate裡面 也可定義某人不能執行





// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');



// 群組起來   登入狀態 ↓   並   ↓ 設定權限
Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function(){
    // 設定頁面
    // 前面的 /admin 可以拿掉
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/news', 'NewsController@news');
    // 產品品項
    Route::get('/product/item', 'ProductController@product');
    Route::get('/product/item/create', 'ProductController@create');
    Route::get('/product/item/edit/{id}', 'ProductController@edit');
    Route::post('/product/item/store', 'ProductController@store');
    Route::post('/product/item/update/{id}', 'ProductController@update');
    Route::delete('/product/item/delete/{id}', 'ProductController@delete');
    // 產品種類
    Route::get('/product/type', 'ProductTypeController@type');
    Route::get('/product/type/create', 'ProductTypeController@create');
    Route::get('/product/type/edit/{id}', 'ProductTypeController@edit');
    Route::post('/product/type/store', 'ProductTypeController@store');
    Route::post('/product/type/update/{id}', 'ProductTypeController@update');
    Route::delete('/product/type/delete/{id}', 'ProductTypeController@delete');
    // 會員管理
    Route::get('/user', 'UserController@index');
    Route::get('/user/create', 'UserController@create');
    Route::post('/user/store', 'UserController@store');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::post('/user/update/{id}', 'UserController@update');
    Route::delete('/user/delete/{id}', 'UserController@delete');
    // 最新消息
    Route::get('/news', 'NewsController@news');
    Route::get('/news/create', 'NewsController@create');
    Route::get('/news/edit/{id}', 'NewsController@edit');
    Route::post('/news/store', 'NewsController@store');
    Route::post('/news/update/{id}', 'NewsController@update');
    Route::delete('/news/delete/{id}', 'NewsController@delete');

    Route::post('/deleteImage', 'FileController@deleteImage');
    
});
