<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsImages extends Model
{
    protected $guarded=[];
    public static function setImage($good_id,$data=[]){

        if ($data){
            foreach ($data as $vo){
                self::create([
                    'goods_id'=>$good_id,
                    'image'=>$vo,
                ]);

            }
        }
    }
    public function goods(){
        return $this->belongsTo(Goods::class);
    }
}
