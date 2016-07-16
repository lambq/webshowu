<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //网站文章数据库
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('art_id');
            $table->integer('user_id')->unsigned()->comment('用户关联ID');
            $table->smallInteger('cate_id')->unsigned()->comment('分类关联ID');
            $table->string('art_title','100')->comment('文章标题');
            $table->string('art_tags','50')->comment('文章标签');
            $table->string('copy_from','50')->comment('来源名称');
            $table->string('copy_url','200')->comment('来源地址');
            $table->string('org_url','255')->comment('采集地址');
            $table->string('art_intro','200')->comment('文章简介');
            $table->longText('art_content')->comment('文章内容');
            $table->integer('art_views')->unsigned()->comment('文章浏览数');
            $table->tinyInteger('art_ispay')->unsigned()->comment('文章是否支付');
            $table->tinyInteger('art_istop')->unsigned()->comment('文章是否置顶');
            $table->tinyInteger('art_isbest')->unsigned()->comment('文章是否');
            $table->tinyInteger('art_status')->unsigned()->comment('文章审核状态');
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
        Schema::drop('articles');
    }
}
