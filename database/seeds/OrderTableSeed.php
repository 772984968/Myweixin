<?php

use Illuminate\Database\Seeder;

class OrderTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);
        for($i=0;$i<20;$i++){
            \App\Models\Order::create([
                'goods_sn'=>$faker->uuid,
                'user_id'=>random_int(1,2),
                'address_id'=>random_int(1,2),
                'order_status_id'=>random_int(1,9),
                'goods_price'=>rand(1,1000),
                'pay_price'=>rand(1,999),
                'order_amount'=>random_int(1,10),
                'pay_time'=>date('Ymdhis'),

            ]);
        }

    }
}
