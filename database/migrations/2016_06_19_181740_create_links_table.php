<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //友情链接
        Schema::create('links', function (Blueprint $table) {
            $table->increments('link_id');
            $table->string('link_name','50')->comment('链接名称');
            $table->string('link_url','255')->comment('链接地址');
            $table->string('link_logo','255')->comment('链接LOGO');
            $table->tinyInteger('link_hide')->unsigned()->comment('链接是否开启');
            $table->tinyInteger('link_order')->unsigned()->comment('链接排序');
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
        Schema::drop('links');
    }
}
