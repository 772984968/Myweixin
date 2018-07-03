<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有类型 ID 数组
        $user_ids = \App\Models\User::all()->pluck('id')->toArray();
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);
        $address = factory(\App\Models\Address::class)
            ->times(20)
            ->make()
            ->each(function ($addr, $index)
            use ($user_ids, $faker)
            {
                // 从用户 ID 数组中随机取出一个并赋值
                $addr->user_id = $faker->randomElement($user_ids);
            });
        // 将数据集合转换为数组，并插入到数据库中
        \App\Models\Address::insert($address->toArray());
    }
}
