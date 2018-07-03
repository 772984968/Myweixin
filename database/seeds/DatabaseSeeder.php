<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(CollectTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(GoodsTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(OrderStatusTableSeed::class);
        $this->call(OrderTableSeed::class);
     }
}
