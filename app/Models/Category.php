<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    protected $guarded = [];

    //获取子孙节点
    public static function getSonCategory($id)
    {
        if ($id===null){
            return [];
        }
        if ($id=='pid') {


            return Category:: whereNull('parent_id')->select('id', 'name')->get();
        }

          return  Category::where('parent_id',$id)->select('id','name')->get();

    }
    public function goods(){
        return $this->hasMany(Goods::class);
    }
}
