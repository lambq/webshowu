<?php

namespace App\Http\Controllers\Ceshi;

use App\Models\Article;
use League\HTMLToMarkdown\HtmlConverter;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MakedownController extends Controller
{
    /**
     * 标签
     *
     * @return void
     */
    public function index(Request $request){
        $converter = new HtmlConverter();
        $articles = Article::where('art_id', $request->id)->where('art_status','3')->first();
        $markdown = $converter->convert($articles->art_content);
        echo $markdown;
    }

    public function sql(Request $request){
        $converter = new HtmlConverter(array('strip_tags' => true));
        $articles = Article::select('art_id','art_content')->skip(5000)->take(1000)->get();
        foreach($articles as $v){
            DB::table('articles')
                ->where('art_id', $v->art_id)
                ->update(['art_content' => $converter->convert( $v->art_content )]);
            echo $v->art_id."===ok<br/>";
        }
    }
}
