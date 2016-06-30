<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQrcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //网站所有二维码的数据
        Schema::create('qrcodes', function (Blueprint $table) {
            $table->increments('qr_id');
            $table->integer('user_id')->unsigned(); //用户关联ID字段
            $table->smallInteger('cate_id')->unsigned(); //分类关联ID字段
            $table->string('org_url','255'); //采集数据源地址
            $table->string('qr_name','100'); //二维码名称
            $table->string('qr_pubname','100'); //发布人号码
            $table->string('qr_tags','255'); //TAG标签
            $table->string('qr_pic','255'); //二维码缩略图
            $table->string('qr_img','255');  //二维码图片
            $table->text('qr_intro'); //网站简介
            $table->integer('qr_views')->unsigned(); //浏览次数
            $table->tinyInteger('qr_status')->unsigned(); //审核状态 1=黑名单 2=待审核 3=已审核
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
        Schema::drop('qrcodes');
    }
}
