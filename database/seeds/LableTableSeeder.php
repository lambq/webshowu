<?php

use Illuminate\Database\Seeder;

class LableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //网站标签填充
        $websites = DB::select('select * from websites');
        foreach($websites as $str){
          $array = explode(",",$str->web_tags);
          foreach($array as $tag){
            if($tag != 'null' && $tag != ''){
              $lab = DB::table('lables')->where('lab_name', $tag)->first();
              if(!isset($lab)){
                DB::table('lables')->insert([
                  'lab_name' => $tag,
                  'lab_tags' => $tag,
                  'lab_intro' => $tag,
                  'cate_mod' => 'webdir',
                  'lab_views' => '10',
                  'created_at' => $str->created_at?$str->created_at:date('Y-m-d H:i:s',time()),
                  'updated_at' => $str->updated_at?$str->updated_at:date('Y-m-d H:i:s',time()),
                ]);	
              }
            }
          }
        }
        $articles = DB::select('select * from articles');
        foreach($articles as $str){
          $array = explode(",",$str->art_tags);
          foreach($array as $tag){
            if($tag != 'null' && $tag != ''){
              $lab = DB::table('lables')->where('lab_name', $tag)->first();
              if(!isset($lab)){
                DB::table('lables')->insert([
                  'lab_name' => $tag,
                  'lab_tags' => $tag,
                  'lab_intro' => $tag,
                  'cate_mod' => 'article',
                  'lab_views' => '10',
                  'created_at' => $str->created_at?$str->created_at:date('Y-m-d H:i:s',time()),
                  'updated_at' => $str->updated_at?$str->updated_at:date('Y-m-d H:i:s',time()),
                ]);
              }
            }
          }
        }
    }
}
