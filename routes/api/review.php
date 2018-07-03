<?php

//回顾列表
$api->get('list','ReviewController@review');
//添加回顾
$api->post('add','ReviewController@setReview');
//回顾详情
$api->get('detial','ReviewController@reviewDetial');
