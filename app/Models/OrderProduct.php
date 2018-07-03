<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable=['order_id','goods_id','price','amount'];
    public function goods(){
        return $this->belongsTo(Goods::class);
    }
}
