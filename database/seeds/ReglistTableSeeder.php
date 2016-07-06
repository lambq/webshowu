<?php

use Illuminate\Database\Seeder;

class ReglistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //网站采集规则数据填充
        $dir_reg_list = DB::connection('webshowu')->select('select * from reglists');
        foreach($dir_reg_list as $str){
          DB::table('reglists')->insert([
          'reg_id' => $str->reg_id ,
          'reg_url' => $str->reg_url,
          'reg_type' => $str->reg_type,
          'reg_host' => $str->reg_host,
          'reg_list' => $str->reg_list,
          'reg_ishost' => $str->reg_ishost,
          'cate_id' => $str->cate_id,
          'reg_content' => $str->reg_content,
          'reg_status' => $str->reg_status,
          'created_at' => $str->created_at,
          'updated_at' => $str->updated_at,
          ]);
        }
    }
}
