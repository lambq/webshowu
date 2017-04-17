<?php

namespace App\Http\Controllers\Ceshi;

use League\HTMLToMarkdown\HtmlConverter;
use phpQuery;
use Redirect;
use Validator;
use Storage;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CeshiController extends Controller
{
    //
    public function index(Request $request) {
        $list = DB::table('5118_list')->get();
        foreach($list as $v){
            phpQuery::newDocumentFile($v->href);
            foreach(pq('.type-wrap ul li') as $k => $vv){
                $val['href']    = 'http://www.5118.com'.pq($vv)->find('a')->attr('href');
                $val['name']    = trim(pq($vv)->find('a')->text());
                $val['tid']      = $v->id;
                if($k != 0 && $k != 1){
                    DB::table('5118_list')->insert($val);
                }
            }
        }
    }
}
