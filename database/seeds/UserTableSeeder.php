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
            'id' => $str->id ,
            'name' => $str->name,
            'email' => $str->email,
						'avatar' => $str->avatar,
            'password' => $str->password,
						'github_id' => $str->github_id,
            'remember_token' => $str->remember_token,
            'created_at' => $str->created_at,
            'updated_at' => $str->updated_at,
          ]);
        }
    }
}
