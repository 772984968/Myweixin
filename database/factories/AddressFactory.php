<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Address::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone'=>$faker->phoneNumber,
        'province' =>array_random(['广东','湖南','江西','四川','广西壮族自治区']),
        'city'=>array_random(['北京市','上海市','广州','武汉','南京','南宁','深圳','佛山']),
        'area'=>array_random(['A区','B区','C区','D区','E区','F区','G区','H区','I区','J区']),
        'detail_address'=>$faker->address,
        'default'=>random_int(0,1)
       ];
});
