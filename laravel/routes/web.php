<?php

// 第一引数は「URLの文字列」, 第二引数は「どのコントローラの何の処理かの文字列」
Route::get('/hello', 'LineBotController@index');

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
