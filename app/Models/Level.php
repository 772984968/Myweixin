<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable=['level'];
    //获取等级名称
    public static function getName($level_id){
        $level=self::where('id',$level_id)->select('level')->first();
        if ($level){
            return $level->level;
        }
        return '';


    }
}
