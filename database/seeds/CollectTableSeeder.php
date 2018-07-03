<?php

use Illuminate\Database\Seeder;

class CollectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1;$i<10;$i++){
                \App\Models\Collection::create([
                    'user_id'=>random_int(1,3),
                    'goods_id'=>random_int(1,100),
                ]);
            }

  }
}
