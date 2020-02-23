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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::group(['middleware' => 'check'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/products/new', 'ProductsController@new')->name('products.new');
    Route::post('/products/new', 'ProductsController@create')->name('products.create');
    Route::get('/products',  'ProductsController@index')->name('products');
    Route::post('/products',  'ProductsController@index')->name('products');
    Route::get('/products/{id}/edit', 'ProductsController@edit')->name('products.edit');
    Route::post('/products/{id}/edit', 'ProductsController@update')->name('products.update');
    Route::post('/products/{id}/delete', 'ProductsController@delete')->name('products.delete');
    Route::get('/products/mypage', 'ProductsController@mypage')->name('products.mypage');
    Route::get('/products/{id}',  'ProductsController@shows')->name('products.show');
    //注文
    Route::post('/products/{id}',  'OrdersController@create')->name('orders.create');
    Route::get('/bords',  'OrdersController@create')->name('orders.create');
    Route::get('/bords',  'BordsController@index')->name('bords');

    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    //ユーザー
    Route::get('/profile/{id}/edit', 'ProfilesController@edit')->name('profile.edit');
    Route::post('/profile/{id}/edit', 'ProfilesController@update')->name('profile.update');
    Route::get('/profile/{id}',  'ProfilesController@show')->name('profile.show');
    Route::get('/profile/{id}/delete',  'ProfilesController@deleteShow')->name('profile.deleteShow');
    Route::post('/profile/{id}/delete',  'ProfilesController@deleteData')->name('profile.deleteData');

    //パスワード変更
    Route::get('changepassword', 'HomeController@showChangePasswordForm');
    Route::post('changepassword', 'HomeController@changePassword')->name('changepassword');



});

// Route::get('/{any?}', function () {
//     return view('index');
// })->where('any', '.+');