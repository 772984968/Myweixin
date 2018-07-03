<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id')->comment('商品ID');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('order_id')->comment('订单ID');
            $table->string('content',255)->comment('评论内容');
            $table->tinyInteger('goods_rank')->comment('商品评分');
            $table->integer('hidden')->default(0)->comment('是否匿名');
            $table->tinyInteger('check')->nullable()->default(0)->comment('审核');
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
        Schema::dropIfExists('comments');
    }
}
