<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //站点数据表
        Schema::create('websites', function (Blueprint $table) {
            $table->increments('web_id');//网站自增长ID
            $table->integer('user_id')->unsigned(); //用户关联ID字段
            $table->smallInteger('cate_id')->unsigned(); //分类关联ID字段
            $table->string('web_name','100'); //网站名称
            $table->string('web_url','255'); //网站域名
            $table->string('web_tags','255'); //TAG标签
            $table->string('web_pic','100'); //网站截图
            $table->text('web_intro'); //网站简介
            $table->tinyInteger('web_ispay')->unsigned(); //是否付费
            $table->tinyInteger('web_istop')->unsigned(); //是否置顶
            $table->tinyInteger('web_isbest')->unsigned(); //是否推荐
            $table->tinyInteger('web_islink')->unsigned(); //
            $table->integer('web_ip')->unsigned(); //服务器IP
            $table->tinyInteger('web_grank')->unsigned(); //PageRank
            $table->tinyInteger('web_brank')->unsigned(); //BaiduRank
            $table->tinyInteger('web_srank')->unsigned(); //SogouRank
            $table->integer('web_arank')->unsigned(); //AlexaRank
            $table->integer('web_instat')->unsigned(); //点入次数
            $table->integer('web_outstat')->unsigned(); //点出次数
            $table->integer('web_views')->unsigned(); //浏览次数
            $table->tinyInteger('web_status')->unsigned(); //审核状态 1=黑名单 2=待审核 3=已审核
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
        Schema::drop('websites');
    }
}
