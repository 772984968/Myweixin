<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table='goods';
    protected $fillable = ['goods_name','category_id','goods_sn','brand_id','goods_number','market_price','shop_price',
        'promote_price','keywords','goods_brief','goods_desc','goods_thumb','goods_img','is_new','is_hot','is_promote',
        'sort','sales_sum','is_on_sale','created_at'];

    //图片关联
    public function images(){

        return $this->hasMany(GoodsImages::class);
    }
    //类型关联
    public function category(){
        return $this->belongsTo(Category::class);

    }
}
