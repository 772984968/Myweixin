<?php
Route::any('category/getData','CategoryController@getData')->name('category.getData');
Route::get('category/detail','CategoryController@detail')->name('category.detail');
Route::get('category/getCategory','CategoryController@getCategory')->name('category.getCategory');
Route::resource('category','CategoryController');
