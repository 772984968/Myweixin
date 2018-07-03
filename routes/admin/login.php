<?php

//后台登陆-前端
 Route::get('login','LoginController@index')->name('login');
//后台登陆-后端
Route::post('login','LoginController@login')->name('login');
//退出
Route::get('logout','LoginController@logout')->name('logout');