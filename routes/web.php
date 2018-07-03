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
//后台URI统一路由
include_once __DIR__ . '/admin/web.php';

Route::get('/',function (){

    return redirect(route('login'));
});
Route::get('/admin',function (){
    return redirect(route('login'));
});
