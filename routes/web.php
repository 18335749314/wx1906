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
//小测试
//Route::get('/ceshi/create','CeShi\CeShiController@create');
//Route::post('/ceshi/create_do','CeShi\CeShiController@create_do');
//Route::get('/ceshi/lists','CeShi\CeShiController@lists');

//主页  素材
Route::prefix('admin')->group(function(){
    Route::any('/login','Admin\LoginController@login');
    Route::any('/do_login','Admin\LoginController@do_login');

    //素材
    Route::any('/index','Admin\IndexController@index');
    Route::any('/add','Admin\IndexController@add');
    Route::any('/add_do','Admin\IndexController@add_do');
    Route::any('/list','Admin\IndexController@list');

    //微信
    Route::any('/wechat','Admin\WechatController@wechat');

    //二维码
    Route::any('/add_do','Admin\ChannelController@add_do');
});

//渠道
Route::prefix('channel')->group(function(){
     //渠道添加
     Route::any('/add','Channel\ChannelController@add');
     Route::any('/add_do','Channel\ChannelController@add_do');
     Route::any('/list','Channel\ChannelController@list');
});


//新闻
Route::prefix('news')->group(function(){
    Route::any('add','News\NewsController@add');
    Route::any('add_do','News\NewsController@add_do');
    Route::any('list','News\NewsController@list');
    Route::any('delete/{id}','News\NewsController@delete');
});
