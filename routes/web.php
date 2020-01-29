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
// Route::get('/{any?}', function () {
//     return view('welcome');
// })->where('any', '.+');

Auth::routes();

Route::group(['middleware' => 'check'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/contents/new', 'ProductsController@new')->name('contents.new');
    Route::post('/contents/new', 'ProductsController@create')->name('contents.create');
    Route::get('/contents',  'ProductsController@index')->name('contents');
    Route::get('/contents/{id}/edit', 'ProductsController@edit')->name('contents.edit');
    Route::post('/contents/{id}/edit', 'ProductsController@update')->name('contents.update');
    Route::post('/contents/{id}/delete', 'ProductsController@delete')->name('contents.delete');
    Route::get('/mypage', 'ProductsController@mypage')->name('contents.mypage');
});
