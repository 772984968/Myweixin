<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('id');
            $table->string('name',30)->nullable()->comment('名字');
            $table->string('username',50)->nullable()->unique()->comment('登陆用户名');
            $table->string('email')->nullable()->unique()->comment('id');
            $table->string('password')->nullable()->comment('用户密码');
            $table->string('phone')->nullable()->comment('手机号码');
            $table->integer('credits')->default(0)->comment('积分');
            $table->string('weapp_openid')->nullable()->unique()->comment('小程序openid');
            $table->string('weixin_session_key')->nullable()->comment('小程序session_key');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
