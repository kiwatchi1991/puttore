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

Route::group(['middleware' => 'check'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/contents/new', 'ContentsController@new')->name('contents.new');
    Route::post('/contents', 'ContentsController@create')->name('contents.create');
    Route::get('/contents',  'ContentsController@index')->name('contents');
    Route::get('/contents/{id}/edit', 'ContentsController@edit')->name('contents.edit');
    Route::post('/contents/{id}/edit', 'ContentsController@update')->name('contents.update');
    Route::post('/contents/{id}/delete', 'ContentsController@delete')->name('contents.delete');
    Route::get('/mypage', 'ContentsController@mypage')->name('contents.mypage');
});
