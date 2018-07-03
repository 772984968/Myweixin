<?php
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace'=>'App\Http\Controllers\Api'],function($api){

        //公共接口
        require_once __DIR__.'/api/common.php';

        //用户管理
        $api->group(['prefix'=>'user'],function($api){
            require_once __DIR__.'/api/user.php';
        });

        //商品
        $api->group(['prefix'=>'product'],function($api){
            require_once __DIR__.'/api/product.php';
        });
        //订单
        require_once __DIR__.'/api/order.php';

        //订单
        require_once __DIR__.'/api/cart.php';

        //权限验证
        $api->group(['middleware' => 'auth:api'], function ($api) {
         });
    });
 });
