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

Route::get('/test',function(){
    echo date('Y-m-d h:i:s');
});

Route::get('/info',function(){
    phpinfo();die;
});

Route::get("/curl/post1","TestController@curlPost1");  //curl测试 form-data
Route::get("/curl/post2","TestController@curlPost2");   //curl    x-www-form-urlencoded
Route::get("/curl/post3","TestController@curlPost3");  //curl   raw

Route::get("/curl/upload","TestController@curlUpload");  //上传文件

Route::get("/guzzle/get1","TestController@guzzleGet");  //上传文件
Route::get("/guzzle/post1","TestController@guzzlePost");  //上传文件
Route::get("/guzzle/post2","TestController@guzzlePost2");  //上传文件
