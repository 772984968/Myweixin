<?php
namespace App\libraries;
/**
 * Created by PhpStorm.
 * User: haobo
 * Date: 2018/4/20
 * Time: 15:34
 * 短信类
 */
class  Sms{

    public $username;                           //帐号
    public $validMinute = 5;                    //短信有效时间(分钟)
    //缓存的关键字
    const SMS_REGISTER = 'sms_register';      //注册【缓存名称】
    const SMS_FIND = 'sms_find';      //找回密码【缓存名称】
    const SMS_MODIFY = 'sms_modify';      //修改密码【缓存名称】
    public  $error=null;//错误信息

    //场景
    public  function scenarios($scenarios,$request)
    {
        switch ($scenarios){
            case 'register':$redis_key=self::SMS_REGISTER;
            case 'find':$redis_key=self::SMS_FIND;
            case 'modify':$redis_key=self::SMS_MODIFY;
        }

        if (!$this->checkSendNumber($redis_key)){
            return $this->error;
        }
        //发送短息验证码
        if (!$this->register()){
               $this->saveSendNumber();
            return true;
        };
        return $this->error;






    }
    //检测发送的数据
    public function checkSendNumber( $key )
    {

        if(!RedisNode::listFirstCheck($key.$this->username,1)) {
            $this->addError('username', '60秒内不能重复发送!');
            return false;
        }elseif(!RedisNode::listCountCheck($key.$this->username, 99999, 3600*24)) {
            $this->addError('username', '24小时内不能超过3次!');
            return false;
        }

        $ip = ip2long(Yii::$app->getRequest()->getUserIP());

        if(!RedisNode::listCountCheck(static::REGISTER_IP.$ip, 99999, 3600*24)) {
            $this->addError('username', '1个IP24小时内不能超过6次!');
            return false;
        }
    }


    public function register()
    {




        if( $this->validate() )
        {
            $sendClass = $this->sendClass;
            if( $sendClass::register($this->username) ) {

                //手机发送记录加1
                $redis = Yii::$app->redis;
                $redis->lpush( self::REGISTER_NAME.$this->username, time() );
                $redis->expire( self::REGISTER_NAME.$this->username,3600*24 );

                //IP发送记录加1
                $ip = ip2long( Yii::$app->getRequest()->getUserIP() );
                $redis->lpush( self::REGISTER_IP . $ip, time() );
                $redis->expire( self::REGISTER_IP . $ip,3600*24 );

                //设置验证码有效期
                Yii::$app->getCache()->set(self::REGISTER_CODE . $this->username, $sendClass::$code, $this->validMinute * 60);
                return true;

            } else {
                //发送失败
                $this->addError('username', Yii::t('common','sms_send_error'));
                return false;
            }
        }
    }

    //取短信验证码
    public static function getRegisterNote( $username )
    {

        return Yii::$app->getCache()->get( self::REGISTER_CODE . $username);
    }

    //删除短信验证码
    public static function delRegisterNode( $username )
    {
        Yii::$app->getCache()->delete( self::REGISTER_CODE . $username );
    }

    /**
     * 验证注册验证码 , 验证3次失败删除验证码
     * @param $code     注册账号,验证码
     * @param $username   注册账号手机
     * @return bool
     */
    public static function checkRegister($username,$code)
    {
        if( self::getRegisterNote($username) == $code ) {
            return true;
        } else {
            $redis = Yii::$app->redis;
            $keyName = self::REGISTER_CODE_ERROR . $username;
            $redis->incr( $keyName );

            if( $redis->get( $keyName ) >= 99999 ) {
                self::delRegisterNode( $username );
                $redis->del( $keyName );
            }
            return false;
        }
    }


    /**
     * 找回密码
     * @return bool
     */
    public function findpassword()
    {

        if($this->validate())
        {
            $sendClass = $this->sendClass;
            if( $sendClass::find($this->username) ) {
                //发送成功
                //手机发送记录加1
                $redis = Yii::$app->redis;
                $redis->lpush( self::FIND_NAME.$this->username, time() );

                //IP发送记录加1
                $ip = ip2long( Yii::$app->getRequest()->getUserIP() );
                $redis->lpush( self::REGISTER_IP . $ip, time() );

                //设置验证码有效期
                Yii::$app->getCache()->set(self::FIND_CODE . $this->username, $sendClass::$code, $this->validMinute * 60);

                return true;

            } else {
                //发送失败
                $this->addError('username','验证码发送失败,请稍后再试!');
                return false;
            }
        }
    }


    //取短信验证码
    public static function getFindNote( $username )
    {

        return Yii::$app->getCache()->get( self::FIND_CODE . $username);
    }


    //删除短信验证码
    public static function delFindNode( $username )
    {
        Yii::$app->getCache()->delete( self::FIND_CODE . $username );
    }


    /**
     * 验证找密验证码
     * @param $code     注册账号,验证码
     * @param $username   注册账号手机
     * @return bool
     */
    public static function checkfindpassword($username,$code)
    {

        $find_code = self::getFindNote( $username );

        if(empty($find_code) ) {
            return false;
        }

        if( $find_code == $code ) {
            return true;
        } else {
            $redis = Yii::$app->redis;
            $keyName = self::FIND_CODE_ERROR . $username;
            $redis->incr( $keyName );

            if( $redis->get( $keyName ) >= 3 ) {
                self::delRegisterNode( $username );
                $redis->del( $keyName );
            }
            return false;
        }
    }






}

