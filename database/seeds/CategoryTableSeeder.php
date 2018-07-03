<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        $categories = [
            [
                'name'        => '手机数码',

            ],
            [
                'name'        => '服装服饰',

            ],
            [
                'name'        => '电脑配件',

            ],
            [
                'name'        => '家具家居',

            ],
            [
                'name'=>'鞋类配饰',
            ]
        ];
        foreach ($categories as $vo){
            $node=Category::create($vo);
            $node->saveAsRoot();
        }


         $this->level2();
         $this->level3();
    }
    public function level2(){
        $level2=[
            ['手机通讯','手机配件','电子配件']
            ,['女装','男装','配饰']
            ,['游戏设备','网络产品','电脑设备']
            ,['生活日品','家纺','厨具']
            ,['男鞋','女鞋','儿童鞋']];

            foreach ($level2 as $key=>$value){
                foreach ($value as $vo){
                        $node=new Category();
                        $node->parent_id=$key+1;
                        $node->name=$vo;
                        $node->level=1;
                        $node->save();
                }

            }
   } public function level3(){
    $level3=[['手机','老人手机']
        ,['耳机','贴膜']
        ,['电池','存储卡',]
        ,['裙子','衣服']
        ,['裤子','上衣',]
        ,['耳环','背包',]
        ,['游戏周边','游戏软件',]
        ,['网线','路由器']
        ,['鼠标','键盘']
        ,['纸巾','洗发水']
        ,['被子','床垫']
        ,['煤气','洗碗机']
        ,['波鞋','皮鞋']
        ,['皮鞋','高跟鞋']
        ,['小鞋','宝宝鞋']
    ];
    $key=6;
    foreach ($level3 as $value){
        foreach ($value as $vo){
            $node=new Category();
            $node->parent_id=$key;
            $node->name=$vo;
            $node->level=2;
            $node->save();
        }
        $key++;

    }
}

}
