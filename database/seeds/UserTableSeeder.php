<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //用户表数据导入切换
        $dir_users = DB::connection('webshowu')->select('select * from users');
        foreach($dir_users as $str){
          DB::table('users')->insert([
            'id' => $str->user_id ,
            'name' => $str->nick_name,
            'email' => $str->user_email,
            'password' => $str->user_pass,
            'remember_token' => '',
            'created_at' => $str->created_at,
            'updated_at' => $str->updated_at,
          ]);
        }
    }
}
