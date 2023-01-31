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
    return view('tops.top');
});

// ログイン
Auth::routes();



// プロフィール関連
Route::resource('users','UserController')->only([
    'show','index'
    ]);
Route::get('/','UserController@index')->name('top');
// プロフィール編集
Route::get('/profile/edit','UserController@edit')->name('profile.edit');
// 更新
Route::patch('/profile','UserController@update')->name('profile.update');
// プロフィール画像編集
Route::get('/profile/edit_image','UserController@editImage')->name('profile.edit_image');
// 更新
Route::patch('/profile/edit_image','UserController@updateImage')->name('profile.update_image');




// 　お気に入り
Route::get('like','LikeController@index')->name('likes.index');
Route::patch('/users/{user}/toggle_like','UserController@toggleLike')->name('users.toggle_like');
    

// 出品商品一覧
Route::get('/users/{user}/exhibitions','UserController@exhibitions')->name('users.exhibitions');

Route::resource('items','ItemController');
// 商品編集
Route::get('/items/{item}/edit','ItemController@edit')->name('items.edit');
// 更新
Route::patch('/items/{item}','ItemController@update')->name('items.update');
// 画像編集
Route::get('/items/{item}/edit_image','ItemController@editImage')->name('items.edit_image');
// 更新
Route::patch('/items/{item}/edit_image','ItemController@updateImage')->name('items.update_image');
// 商品詳細
Route::get('/items/{item}','ItemController@show')->name('items.show');
// 購入かくにん
Route::get('/items/{item}/confirm','ItemController@confirm')->name('items.confirm');
// 購入確定
Route::get('/items/{item}/finish','ItemController@finish')->name('items.finish');



