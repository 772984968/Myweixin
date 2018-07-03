<?php

$api->group(['middleware' => 'auth:api'], function ($api) {

//订单
    $api->resource('cart','CartController');




});

