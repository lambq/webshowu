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
            $table->increments('cate_id');
            $table->smallInteger('root_id')->unsigned()->comment('父级分类ID');
            $table->enum('cate_mod', array('webdir', 'article','qrcode'))->comment('分类类型 webdir=网站 article=文章');
            $table->string('cate_name','50')->comment('分类名称');
            $table->string('cate_dir','50')->comment('目录名称');
            $table->string('cate_url','255')->comment('跳转地址');
            $table->string('cate_img','255')->comment('分类图片');
            $table->tinyInteger('cate_isbest') ->unsigned()->comment('设置推荐 0 否 1是');
            $table->smallInteger('cate_order')->unsigned()->comment('设置排序');
            $table->string('cate_keywords','100')->comment('分类SEO关键词');
            $table->string('cate_description','255')->comment('分类SEO描述');
            $table->string('cate_arrparentid','255')->comment('分类属性设置');
            $table->text('cate_arrchildid')->comment('分类子集');
            $table->tinyInteger('cate_childcount')->unsigned()->comment('标签名称');
            $table->smallInteger('cate_postcount')->unsigned()->comment('内容统计多少条');
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
