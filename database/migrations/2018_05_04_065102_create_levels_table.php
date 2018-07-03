<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('level')->comment('等级');
            $table->timestamps();
        });
        $this->seedLevel();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }
    public function seedLevel(){
        $level=[
            '白生',
            '童生',
            '秀才',
            '举人',
            '贡生',
            '进士',
            '大学士',
        ];
        for ($i=0;$i<count($level);$i++){
            Db::table('levels')->insert(['level'=>$level[$i]]);
        }

    }
}
