<?php
//类型列表
$api->get('category','CategoryController@index')->name('Category.index');

//最新商品列表
$api->get('product/new','ProductController@is_new')->name('Product.new');

//推荐商品列表
$api->get('product/hot','ProductController@is_hot')->name('Product.hot');

//Banner列表
$api->get('banner','CommonController@banner')->name('banner');