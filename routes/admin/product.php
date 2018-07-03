<?php
Route::any('product/getData','ProductController@getData')->name('product.getData');
Route::get('product/detail','ProductController@detail')->name('product.detail');
Route::post('product/delImage','ProductController@delImage')->name('product.delImage');
Route::post('product/switchSale','ProductController@switchSale')->name('product.switchSale');
Route::resource('product','ProductController');
