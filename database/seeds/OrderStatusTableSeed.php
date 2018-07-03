<?php

use Illuminate\Database\Seeder;

class OrderStatusTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status=['待付款','已取消','已支付,待发货','已发货','已完成','已拒绝','已退款','已失效','失败'];
        foreach ($status as $sta){
            \App\Models\OrderStatus::create([
                'status'=>$sta
        ]);
        }
    }
}
