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

Route::prefix("admin")->namespace("Admin")->group(function(){
    Route::get("/index","IndexController@index");
    Route::prefix("banner")->group(function(){
        Route::get("create","BannerController@create");
        Route::post("store","BannerController@store");
        Route::get("index","BannerController@index");
        Route::get("del","BannerController@del");
        Route::get("updates/{id}","BannerController@updates");
        Route::post("upd","BannerController@upd");
        Route::get("ajaxname","BannerController@ajaxname");
        Route::get("ajaxsorts","BannerController@ajaxsorts");
    });

});
