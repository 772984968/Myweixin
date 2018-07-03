<?php

//开启审核
Route::post('comment/switchSale','CommentController@switchSale')->name('comment.switchSale');
//评论管理
Route::resource('comment','CommentController');
