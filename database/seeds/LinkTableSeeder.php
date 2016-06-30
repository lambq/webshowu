<?php

use Illuminate\Database\Seeder;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //网站友情链接数据填充
        $dir_links = DB::connection('webshowu')->select('select * from links');
        foreach($dir_links as $str){
          DB::table('links')->insert([
          'link_id' => $str->link_id ,
          'link_name' => $str->link_name,
          'link_url' => $str->link_url,
          'link_logo' => $str->link_logo,
          'link_hide' => $str->link_hide,
          'link_order' => $str->link_order,
          'created_at' => $str->created_at,
          'updated_at' => $str->updated_at,
          ]);
        }
    }
}
