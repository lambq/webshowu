<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReglistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //网站数据采集规则表
        Schema::create('reglists', function (Blueprint $table) {
            $table->increments('reg_id');
            $table->string('reg_url','255')->comment('网站域名');
            $table->string('reg_type','255')->comment('采集定向网站');
            $table->string('reg_host','255')->comment('网站域名');
            $table->text('reg_list')->comment('网站采集列表规则');
            $table->tinyInteger('reg_ishost')->unsigned()->comment('是否开启url对接');
            $table->smallInteger('cate_id')->unsigned()->comment('分类关联ID');
            $table->longText('reg_content')->comment('上一次采集的内容');
            $table->tinyInteger('reg_status')->unsigned()->comment('采集状态');
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
        Schema::drop('reglists');
    }
}
