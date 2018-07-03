<?php

//商品详情
$api->get('detail','ProductController@detail')->name('product.detail');
//商品评论
$api->resource('comment','CommentController');

