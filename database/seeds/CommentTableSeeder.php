<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
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
        foreach ($user_ids as $key=>$user){
            \App\Models\Comment::create([
                'goods_id'=>$key+1,
                'order_id'=>$key+1,
                'user_id'=>$user,
                'content'=>$faker->text,
                'goods_rank'=>$faker->numberBetween(1,5),
                'hidden'=>$faker->numberBetween(0,1),
            ]);
        }
        for ($i=0;$i<20;$i++){
            \App\Models\CommentImage::create([
                'comment_id'=>random_int(1,10),
                'image'=>'/uploads/images/20180613/8bf9d7ad34ef2ab027afd7d71515d946.jpg',
            ]);

        }
    }
}
