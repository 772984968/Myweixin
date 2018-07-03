<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Idiom extends  Model
{
    protected  $fillable=[
        'antonym','thesaurus','name','spell'
        ,'explain','derivation','pinyin'
        ,'first_leter','last_word','antonym','story','level_id'];
    public function level(){
        return $this->belongsTo(Level::class)->select('level','id');
    }
    //获取等级数量
    public static function  getCount($level){
         $count=self::where('level_id',$level)->count();
         if ($count) return $count;
         return 0;

    }
    //获取成语 等级ID
    public static function getLevelId($idiom_id){
        $level_id=self::select('level_id')->find($idiom_id);
        if ($level_id)
            return $level_id->level_id;
        return null;
    }
}
