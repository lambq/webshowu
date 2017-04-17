<?php

namespace App\Http\Controllers\Web;

use App\Models\Page;
use App\Models\Link;
use App\Models\Website;
use App\Models\Article;
use Parsedown;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['site_title'] = '网站分类目录提交_免费网站目录外链_dmoz目录-儒尚秀站网';
        $data['site_keywords'] = 'DMOZ目录,网站收录,网站目录,秀站分类目录,分类目录,秀目录,秀站,秀站目录,免费网站目录,儒尚秀站网,秀站网';
        $data['site_description'] = '秀站分类目录为互联网用户提供优秀网站参考的网站目录和网站大全。提供免费网站收录，网站排名，分类目录检索，关键字搜索功能。';
        $data['articles']   = Article::where(['art_status'=>'3','art_isbest'=>'1'])->orderBy('updated_at','desc')->take('16')->get();
        $data['websites']   = Website::where(['web_status'=>'3'])->orderBy('web_isbest','desc')->orderBy('updated_at','desc')->take('5')->get();
        $data['hotsites']   = Website::where(['web_status'=>'3'])->orderBy('updated_at','desc')->take('16')->get();
        $data['bestsites']  = Website::where(['web_isbest'=>'1'])->orderBy('updated_at','desc')->take('10')->get();
        $data['newsites']   = Website::orderBy('created_at','desc')->take('8')->get();
        $data['randsites']  = Website::where(['web_status'=>'3'])->orderBy('created_at','desc')->skip(rand(1,60))->take('24')->get();
        $data['viewsites']  = Website::orderBy('web_views','desc')->take('8')->get();
        $data['web_status'] = Website::where(['web_status'=>'2'])->orderBy('updated_at','desc')->take('8')->get();
        $data['links'] = Link::where(['link_hide'=>'1'])->orderBy('link_order','asc')->get();
        $data['pages'] = Page::get();
        $data['site_nav'] = 'index';
        return view('web/index',$data);
    }
    /**
     * 标签
     *
     * @return void
     */
    public function tags(Request $request)
    {
        return redirect('/');
    }
    /**
     * 帮助中心
     *
     * @return void
     */
    public function diypage(Request $request)
    {
        $data['page_first'] = page::where('page_id',$request->id)->first();
        if($data['page_first']){
            $Parsedown = new Parsedown();
            $data['parsedown']  = $Parsedown->text( $data['page_first']->page_content );
            $data['site_title'] = $data['page_first']->page_name.'-秀站分类目录分享网站价值';
            $data['site_keywords'] = $data['page_first']->page_name.'DMOZ目录,DMOZ分类目录,网站目录,中文网站目录,秀站分类目录,分类目录,秀站,秀站目录,免费网站目录';
            $data['site_description'] = $data['page_first']->page_name;
            $data['pages'] = page::get();
            $data['site_nav'] = 'index';
            return view('web/diypage',$data);
        }else{
            return redirect('/');
        }
    }
}
