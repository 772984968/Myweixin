<?php

use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids=[1,2,3];
        $idiom_ids=[
            [1,2,3,4,5,6],
            [7,8,9,10,11,12],
            [10,20,30,40,50,60],
        ];
        for ($i=0;$i<3;$i++){
            \App\Models\Review::create([
                    'user_id'=>$user_ids[$i],
                    'idiom_ids'=>implode(',',$idiom_ids[$i])
            ]
            );
        }


    }
}
