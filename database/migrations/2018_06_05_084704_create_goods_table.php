<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->comment('商品分类ID');
            $table->string('goods_sn',60)->comment('商品唯一货号');
            $table->string('goods_name',120)->comment('商品的名称');
            $table->integer('brand_id')->nullable()->comment('品牌ID');
            $table->integer('goods_number')->comment('商品库存');
            $table->decimal('market_price',10,2)->comment('市场售价');
            $table->decimal('shop_price',10,2)->comment('本店价格');
            $table->decimal('promote_price',10,2)->nullable()->comment('促销价格');
            $table->string('keywords')->nullable()->comment('商品关键字');
            $table->string('goods_brief')->nullable()->comment('简短描述');
            $table->text('goods_desc')->nullable()->comment('商品详细描述');
            $table->string('goods_thumb')->comment('商品略缩图');
            $table->tinyInteger('is_new')->default(0)->comment('是否新品');
            $table->tinyInteger('is_hot')->default(0)->comment('是否热销');
            $table->tinyInteger('is_promote')->default(0)->comment('是否特价促销');
            $table->integer('sort')->default(0)->comment('商品排序');
            $table->integer('sales_sum')->nullable()->default(0)->comment('商品销量');
            $table->integer('is_on_sale')->default(0)->comment('是否上架');
            $table->timestamps();
            $table->comment='商品表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
