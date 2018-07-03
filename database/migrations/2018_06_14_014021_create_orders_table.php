<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_sn')->comment('订单号');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('address_id')->comment('地址ID');
            $table->integer('order_status_id')->comment('订单状态ID');
            $table->dateTime('pay_time')->nullable()->comment('支付时间');
            $table->decimal('goods_price')->comment('商品总价');
            $table->decimal('pay_price')->nullable()->comment('付款金额');
            $table->decimal('order_amount')->comment('总量');
            $table->string('note')->nullable()->comment('备注');
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
        Schema::dropIfExists('orders');
    }
}
