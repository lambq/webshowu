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
            $table->increments('web_id');
            $table->integer('user_id')->unsigned()->comment('用户关联ID');
            $table->smallInteger('cate_id')->unsigned()->comment('分类关联ID');
            $table->string('web_name','100')->comment('网站名称');
            $table->string('web_url','255')->comment('网站域名');
            $table->string('web_tags','255')->comment('TAG标签');
            $table->string('web_pic','100')->comment('网站截图');
            $table->text('web_intro')->comment('网站简介');
            $table->tinyInteger('web_ispay')->unsigned()->comment('是否付费');
            $table->tinyInteger('web_istop')->unsigned()->comment('是否置顶');
            $table->tinyInteger('web_isbest')->unsigned()->comment('是否推荐');
            $table->tinyInteger('web_islink')->unsigned()->comment('是否链接');
            $table->integer('web_ip')->unsigned()->comment('服务器IP');
            $table->tinyInteger('web_grank')->unsigned()->comment('PageRank');
            $table->tinyInteger('web_brank')->unsigned()->comment('BaiduRank');
            $table->tinyInteger('web_srank')->unsigned()->comment('SogouRank');
            $table->integer('web_arank')->unsigned()->comment('AlexaRank');
            $table->integer('web_instat')->unsigned()->comment('点入次数');
            $table->integer('web_outstat')->unsigned()->comment('点出次数');
            $table->integer('web_views')->unsigned()->comment('浏览次数');
            $table->tinyInteger('web_status')->unsigned()->comment('审核状态 1=黑名单 2=待审核 3=已审核');
            $table->timestamps();
            $table->softDeletes();
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
