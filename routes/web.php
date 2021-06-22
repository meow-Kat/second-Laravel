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

// 做 middleware 來當限制器 can 放在 view 頁面顯示就好
// middleware 參考 app/http / middleware

// 群組起來   登入狀態 ↓   並   ↓ 設定權限 這邊再改 把can:拿掉 到 AdminMiddleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // 設定頁面
    // 前面的 /admin 可以拿掉
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/news', 'NewsController@news');
    // 產品
    Route::prefix('product')->group(function () {
        // 產品品項
        Route::prefix('item')->group(function () {
            Route::get('/', 'ProductController@product');
            Route::get('/create', 'ProductController@create');
            Route::get('/edit/{id}', 'ProductController@edit');
            Route::post('/store', 'ProductController@store');
            Route::post('/update/{id}', 'ProductController@update');
            Route::delete('/delete/{id}', 'ProductController@delete');
        });
        // 產品種類
        Route::prefix('type')->group(function () {
            Route::get('/', 'ProductTypeController@type');
            Route::get('/create', 'ProductTypeController@create');
            Route::get('/edit/{id}', 'ProductTypeController@edit');
            Route::post('/store', 'ProductTypeController@store');
            Route::post('/update/{id}', 'ProductTypeController@update');
            Route::delete('/delete/{id}', 'ProductTypeController@delete');
        });
    });
    // 會員管理
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index');
        Route::get('/create', 'UserController@create');
        Route::post('/store', 'UserController@store');
        Route::get('/edit/{id}', 'UserController@edit');
        Route::post('/update/{id}', 'UserController@update');
        Route::delete('/delete/{id}', 'UserController@delete');
    });
    // 最新消息
    Route::prefix('news')->group(function () {
        Route::get('/', 'NewsController@news');
        Route::get('/create', 'NewsController@create');
        Route::get('/edit/{id}', 'NewsController@edit');
        Route::post('/store', 'NewsController@store');
        Route::post('/update/{id}', 'NewsController@update');
        Route::delete('/delete/{id}', 'NewsController@delete');
    });

    Route::post('/deleteImage', 'FileController@deleteImage');

    // 聯絡我們
    Route::prefix('contact_us')->group(function () {
        Route::get('/', 'ContactusController@contactus');
        Route::get('/look/{id}', 'ContactusController@look');
        Route::delete('/delete/{id}', 'ContactusController@delete');
    });
});

Route::prefix('contact_us')->group(function () {
    Route::get('/', 'FrontController@contactus');
    Route::post('/store', 'FrontController@store');
});
