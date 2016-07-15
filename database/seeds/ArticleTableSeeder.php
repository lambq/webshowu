<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //文章数据填充
        $dir_articles = DB::connection('webshowu')->select('select * from articles');
        foreach($dir_articles as $str){
          DB::table('articles')->insert([
            'art_id' => $str->art_id ,
            'user_id' => $str->user_id,
            'cate_id' => $str->cate_id,
            'art_title' => $str->art_title,
            'art_tags' => $str->art_tags,
            'copy_from' => $str->copy_from,
            'copy_url' => $str->copy_url,
            'art_intro' => $str->art_intro,
            'art_content' => $str->art_content,
            'art_views' => $str->art_views,
            'art_ispay' => $str->art_ispay,
            'art_istop' => $str->art_istop,
            'art_isbest' => $str->art_isbest,
            'art_status' => $str->art_status,
            'created_at' => $str->created_at,
            'updated_at' => $str->updated_at,
          ]);
        }
    }
}
