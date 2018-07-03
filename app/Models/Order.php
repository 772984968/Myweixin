<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable=['goods_sn','user_id','pay_time','note','address_id','order_status_id','goods_price','order_amount','order_status_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orderStatus(){

        return $this->belongsTo(OrderStatus::class);
    }
    public function address(){

        return $this->belongsTo(Address::class);
    }
    public function orderProduct(){

        return $this->hasMany(OrderProduct::class);
    }
}
