<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->integer('user_id')->comment('用户ID');
            $table->string('phone',32)->comment('电话号码');
            $table->string('province',50)->comment('省份');
            $table->string('city',50)->comment('城市');
            $table->string('area',50)->comment('区');
            $table->string('detail_address',100)->comment('详细地址');
            $table->tinyInteger('default')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
