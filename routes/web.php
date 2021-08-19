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
// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::resource('top', 'PostsController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'destroy']]);

// 4.x.1 モーダルの設置
Route::post('update', 'PostsController@update');
Route::get('{id}/delete', 'PostsController@delete');
Route::post('{id}/delete', 'PostsController@delete');

Route::get('/search', 'UsersController@search')->name('search');

// 6 フォローリスト,フォロワーリスト
Route::get('/followList', 'UsersController@followList');
Route::get('/followerList', 'UsersController@followerList');

// 5.2.3 followsテーブルへの登録と削除
Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

// 6.3 ユーザーのアイコンから相手のプロフィールページへの遷移
// Route::resource('users', 'UsersController', ['only' => ['index', 'view', 'show', 'edit', 'update']]);
Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);

// Route::get('/profile', 'UsersController@profile');
