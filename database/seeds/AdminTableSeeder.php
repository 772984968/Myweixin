<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=['admin','lisi','wangwu'];
        for ($i=0;$i<3;$i++){
            Admin::create([
                'username'=>$roles[$i],
                'password'=>bcrypt('123'),
            ]);
   }
    }
}
