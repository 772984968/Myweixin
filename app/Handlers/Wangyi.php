<?php
namespace  App\libraries;
//网易短信
use App\libraries;

class Wangyi extends Curl{
    const CONTENT_TYPE='Content-Type:application/x-www-form-urlencoded;charset=utf-8';
   // const APP_KEY=config('s');
   // const APP_SECRET=config('s');

    //发送短信验证码
    public static function sendCode($mobile,$templateid)
    {
        static $url = 'https://api.netease.im/sms/sendcode.action';
        $data = [
            'mobile' =>$mobile,
            'templateid' =>$templateid,
        ];
        $result = static::sendPost($url,$data,self::checksum());
        if ($result['code']=='200'){
            $rs=json_decode($result['data']);
            if ($rs->code==200){
                return $rs->obj;
            }
        }
        return false;
    }


    //校验验证码
    public static function verifycode($mobile,$code)
    {
        $data = [
            'mobile' =>$mobile,
            'code' =>$code,
        ];

        static $url = 'https://api.netease.im/sms/verifycode.action';
        $result = static::sendPost($url,$data,self::checksum(self::CONTENT_TYPE));
        if ($result['code']=='200'){
            $rs=json_decode($result['data']);
            if ($rs->code==200){
                return $rs->obj;
            }
        }
        return false;
    }

    //发送通知类和运营类短信
    public static function sendTemplate($mobile,$templateid,$params='')
    {
        $data = [
            'templateid' =>$templateid,
            'mobiles' =>json_encode([$mobile]),
            'params'=>json_encode([$params]),
        ];
        static $url = 'https://api.netease.im/sms/sendtemplate.action';
        $result = static::sendPost($url,$data,self::checksum(self::CONTENT_TYPE));
        if ($result['code']=='200'){
            $rs=json_decode($result['data']);
            if ($rs->code==200){
                return $params;
            }
        }
        return false;
    }

    // 查询通知类和运营类短信发送状态
    public static function queryStatus($sendid)
    {
        $data = [
            'sendid' =>$sendid,
        ];
        static $url = 'https://api.netease.im/sms/querystatus.action';
        $result = static::sendPost($url,$data,self::checksum(self::CONTENT_TYPE));
        if ($result['code']=='200'){
            $rs=json_decode($result['data']);
            if ($rs->code==200){
                return $rs->obj;
            }
        }
        return false;
    }

    /**
     *
     * @param $AppKey开发者平台分配的appkey
     * @param  $Nonce随机数（最大长度128个字符
     * @param  $CurTime当前UTC时间戳，从1970年1月1日0点0 分0 秒开始到现在的秒数(String)
     * @param  $AppSecretSHA1(AppSecret + Nonce + CurTime),三个参数拼接的字符串，进行SHA1哈希计算，转化成16进制字符(String，小写)
     */
    public static function   checksum($type){
        $Nonce=randomkeys(10);
        $CurTime=time();
        $AppSecretSHA1=sha1(self::APP_SECRET.$Nonce.$CurTime);
        $header[]=self::CONTENT_TYPE;
        $header[]='AppKey:'.self::APP_KEY;
        $header[]='CurTime:'.$CurTime;
        $header[]='CheckSum:'.$AppSecretSHA1;
        $header[]='Nonce:'.$Nonce;
        $header[]=$type;
        return $header;

    }


}

