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
        $articles = DB::table('articles')->select(
                'art_id',
                'art_content'
            )->skip(5000)->take(1000)->get();
        foreach($articles as $v){
            $art_thumbnail  = $this->get_pic($v->art_content,0);
            DB::table('articles')->where('art_id', $v->art_id)->update(['art_thumbnail' => $art_thumbnail]);
            echo $v->art_id.'===';
        }
    }

    /** 获取文章第一张图片 **/
    function get_pic($content,$order='ALL'){
        $array = '';
        $pattern="/<img.*?data-original=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern,$content,$match);
        if(isset($match[1])&&!empty($match[1])){
            if($order==='ALL'){
                $array= $match[1];
            }
            if(is_numeric($order)&&isset($match[1][$order])){
                $array= $match[1][$order];
            }
        }
        if(!$array){
            $array = "http://www.webshowu.com/images/loading.jpg";
        }
        return $array;
    }
}
