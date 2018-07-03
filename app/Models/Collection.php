<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{

    protected  $fillable=['user_id','idiom_id','level_id'];
    //关联用户
    public function user(){
        return $this->belongsTo(User::class);
    }
    //关联商品
    public function goods(){
        return $this->belongsTo(Goods::class);

    }


}
