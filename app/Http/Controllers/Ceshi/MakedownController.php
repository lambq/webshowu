<?php

namespace App\Http\Controllers\Ceshi;

use App\Models\Article;
use League\HTMLToMarkdown\HtmlConverter;
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
}
