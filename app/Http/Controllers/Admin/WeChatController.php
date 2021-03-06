<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class WeChatController extends Controller
{

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {

        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return "欢迎关注 overtrue！";
        });

        return $app->server->serve();
    }
    public function createMenu(){
        $app = app('wechat.official_account');
        $buttons = [
            [
                "type" => "click",
                "name" => "菜单",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "商城demo",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "商城demo1",
                        "url"  => "http://tpshop.limaolin.top/index.php/mobile?appID=wx8e036c9c01609e35"
                    ],
                    [
                        "type" => "view",
                        "name" => "商城demo2",
                        "url"  => "http://shop.limaolin.top/index.php/"
                    ],
                    [
                        "type" => "view",
                        "name" => "商城demo3",
                        "url"  => "https://www.baidu.com/"
                    ],
                ],
            ],
        ];
        $app->menu->create($buttons);
    }
    public function delete(){
        $app = app('wechat.official_account');
        $app->menu->delete();

    }
}
