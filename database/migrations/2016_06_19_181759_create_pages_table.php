<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //网站帮助中心
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('page_id');
            $table->string('page_name','50')->comment('文档标题');
            $table->string('page_intro','255')->comment('文档简介');
            $table->text('page_content')->comment('文档内容');
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
        Schema::drop('pages');
    }
}
