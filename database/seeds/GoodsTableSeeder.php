<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Goods;
class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有类型 ID 数组
        $category_ids = Category::all()->pluck('id')->toArray();
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);
        $goods = factory(Goods::class)
            ->times(1000)
            ->make()
            ->each(function ($good, $index)
            use ($category_ids, $faker)
            {
                // 从用户 ID 数组中随机取出一个并赋值
                $good->category_id = $faker->randomElement($category_ids);
            });
        // 将数据集合转换为数组，并插入到数据库中
        Goods::insert($goods->toArray());

    }
}
