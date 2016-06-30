<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //网站用户中心数据填充
        $dir_pages = DB::connection('webshowu')->select('select * from pages');
        foreach($dir_pages as $str){
          DB::table('pages')->insert([
          'page_id' => $str->page_id ,
          'page_name' => $str->page_name,
          'page_intro' => $str->page_intro,
          'page_content' => $str->page_content,
          'created_at' => $str->created_at,
          'updated_at' => $str->updated_at,
          ]);
        }
    }
}
