<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //网站分类数据表
        Schema::create('categories', function (Blueprint $table) {
          $table->increments('cate_id'); //分类表自增长ID
          $table->smallInteger('root_id')->unsigned(); //父级分类ID
          $table->enum('cate_mod', array('webdir', 'article','qrcode')); //分类类型 webdir=网站 article=文章
          $table->string('cate_name','50'); //分类名称
          $table->string('cate_dir','50'); //目录名称
          $table->string('cate_url','255');  //跳转地址
          $table->string('cate_img','255');  //分类图片
          $table->tinyInteger('cate_isbest') ->unsigned(); // 设置推荐 0 否 1是
          $table->smallInteger('cate_order')->unsigned(); // 设置排序
          $table->string('cate_keywords','100'); //分类SEO关键词
          $table->string('cate_description','255'); //分类SEO描述
          $table->string('cate_arrparentid','255'); //分类属性设置 
          $table->text('cate_arrchildid'); //分类子集
          $table->tinyInteger('cate_childcount')->unsigned(); 
          $table->smallInteger('cate_postcount')->unsigned(); //内容统计多少条
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
        Schema::drop('categories');
    }
}
