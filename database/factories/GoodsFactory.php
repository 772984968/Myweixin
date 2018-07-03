<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Goods::class, function (Faker $faker) {
    return [
        'goods_sn' => $faker->uuid,
        'goods_name' => $faker->name,
        'goods_number'=>random_int(0,50),
        'market_price' => rand(1,1000),
        'shop_price'=>rand(1,900),
        'promote_price'=>rand(1,800),
        'goods_brief'=>$faker->text(50),
        'goods_desc'=>$faker->text(),
        'goods_thumb'=>$faker->imageUrl(),
        'is_new'=>random_int(0,1),
        'is_hot'=>random_int(0,1),
        'is_promote'=>random_int(0,1),
        'sales_sum'=>random_int(10,50),
        'is_on_sale'=>random_int(0,1),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
