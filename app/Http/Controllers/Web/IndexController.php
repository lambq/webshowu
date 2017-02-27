<?php

namespace App\Http\Controllers\Web;

use App\Models\Categorie;
use App\Models\Page;
use App\Models\Lable;
use App\Models\Link;
use App\Models\Website;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['site_title'] = '秀站分类目录|中文分类目录|网站分类目录|免费网站目录|dmoz目录-北京儒尚科技有限公司';
        $data['site_keywords'] = 'DMOZ目录,DMOZ分类目录,网站收录,网站目录,网站登录,中文网站目录,秀站分类目录,分类目录,秀站分类目录分享网站价值,秀站,秀站目录,免费网站目录';
        $data['site_description'] = '秀站分类目录免费收录各类优秀中文网站，提供网站分类目录检索，关键字搜索，提供网站即可免费快速提升网站流量，分享网站价值也是中国dmoz的标志';
        $data['articles']   = Article::where(['art_status'=>'3','art_isbest'=>'1'])->orderBy('updated_at','desc')->take('16')->get();
        $data['websites']   = Website::where(['web_status'=>'3'])->orderBy('web_isbest','desc')->orderBy('updated_at','desc')->take('5')->get();
        $data['hotsites']   = Website::where(['web_status'=>'3'])->orderBy('updated_at','desc')->take('5')->get();
        $data['bestsites']  = Website::where(['web_isbest'=>'1'])->orderBy('updated_at','desc')->take('10')->get();
        $data['newsites']   = Website::orderBy('created_at','desc')->take('8')->get();
        $data['randsites']  = Website::where(['web_status'=>'3'])->orderBy('created_at','desc')->skip(rand(1,50))->take('18')->get();
        $data['viewsites']  = Website::orderBy('web_views','desc')->take('8')->get();
        $data['web_status'] = Website::where(['web_status'=>'2'])->orderBy('updated_at','desc')->take('8')->get();
        $data['links'] = Link::where(['link_hide'=>'1'])->orderBy('link_order','asc')->get();
        $data['lables'] = Lable::where(['cate_mod'=>'webdir'])->orderBy('lab_views','desc')->take('30')->get();
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
    /**
     * 递归分类目录
     *
     * @return void
     */
    public function cates()
    {
        $array = array();
        $cate = Categorie::where(['cate_isbest'=>'1'])->orderBy('cate_order','asc')->orderBy('cate_id','asc')->get();
        foreach($cate as $str){
            $cate_data['cate_name'] = $str->cate_name;
            $cate_data['cate_id'] = $str->cate_id;
            $collects = explode(",",$str->cate_arrchildid);
            $cate_data['site_array'] = Website::leftJoin('users', 'users.id','=','websites.user_id')->where('websites.web_status','3')->where('websites.web_ispay','1')->whereIn('websites.cate_id',$collects)->orderBy('websites.updated_at','desc')->take('6')->get();
            $array[] = $cate_data;
        }
        return $array;
    }
}
