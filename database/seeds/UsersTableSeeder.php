<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=app(Faker\Generator::class);
        $users=factory(\App\Models\User::class)->times(10)->make();
        $user_array =$users->makeVisible(['password', 'remember_token'])->toArray();
        User::insert($user_array);
        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Maolin';
        $user->email = '772984968@qq.com';
        $user->phone = '15899595363';
        $user->username = '15899595363';
        $user->save();
    }
}
