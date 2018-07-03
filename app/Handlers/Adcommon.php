<?php
namespace App\libraries;
/**
 * Created by PhpStorm.
 * User: haobo
 * Date: 2018/4/20
 * Time: 15:34
 * 公共函数
 */
class  Adcommon{
    /**
     * @desc   检查输入的是否为手机号
     * @access public
     * @param  $val
     * @return bool true false
     */
    public static function isMobile($val)
    {

        //该表达式可以验证那些不小心把连接符“-”写出“－”的或者下划线“_”的等等
        if(preg_match("/^13[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$/",$val))
        {
            return true;
        }
        return false;
    }




}

