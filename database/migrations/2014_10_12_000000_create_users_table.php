<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('用户呢称');
            $table->string('email')->unique()->nullable()->comment('用户邮箱');
            $table->string('avatar')->nullable()->comment('用户头像');
            $table->string('password',60)->comment('用户密码');
            $table->string('github_id')->unique()->nullable()->comment('关联github账号');
            $table->string('api_token', 60)->unique()->nullable()->comment('api密钥');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
