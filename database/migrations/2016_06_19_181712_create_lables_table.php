<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //网站所有标签
        Schema::create('lables', function (Blueprint $table) {
            $table->increments('lab_id');
            $table->string('lab_name','100'); //标签名称
            $table->string('lab_tags','100'); //TAG标签
            $table->text('lab_intro'); //标签简介
            $table->enum('cate_mod', array('webdir', 'article')); //标签类型 webdir=网站 article=文章
            $table->integer('lab_views')->unsigned(); //浏览次数
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
        Schema::drop('lables');
    }
}
