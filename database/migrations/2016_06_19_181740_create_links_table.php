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
            $table->string('link_name','50');
            $table->string('link_url','255');
            $table->string('link_logo','255');
            $table->tinyInteger('link_hide')->unsigned();
            $table->tinyInteger('link_order')->unsigned();
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
