<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category, App\Page, App\Article, App\Website;

class WebdirController extends Controller
{
	/**
	 * 推荐资讯
	 */
    public $art_list;
	/**
	 * 推荐站点
	 */
    public $site_list;
	/**
	 * 初始化数据
	 */
    public function __construct()
	{
      $this->art_list = Article::where(['art_status'=>'3'])->orderBy('art_views','desc')->take('10')->get();
      $this->site_list = Website::where(['web_isbest'=>'1','web_status'=>'3'])->orderBy('updated_at','desc')->take('10')->get();
    }
	/**
	 * 站点首页
	 */
    function index(Request $request)
	{
        $data['site_title'] = '秀目录_网站目录_网站分类目录_网站目录_分类目录';
        $data['site_keywords'] = '秀目录,网站目录,免费网站目录,分类目录,网站分类目录';
        $data['site_description'] = '秀目录网站目录是全人工编辑的开放式网站分类目录，收录国内外、各行业优秀网站，免费网站目录,网站分类目录, 网站提交入口。旨在为用户提供优秀网站目录检索、网站推广服务。';
        $data['cates'] = $this->cates();
        $data['pages'] = Page::get();
        $data['site_nav'] = 'webdir';
        return view('front/webdir_index',$data);
    }
	/**
	 * 站点列表
	 */
    function lists(Request $request)
	{
        if($request->id){
            $cate = Category::where('cate_id', $request->id)->select('cate_arrchildid','cate_name','cate_keywords','cate_description')->first();
            $collects = explode(",",$cate->cate_arrchildid);
            $websites = Website::where('web_status','3')->whereIn('cate_id',$collects)->orderBy('web_id','desc')->paginate(12);
            $data['websites'] = $websites;
            $data['site_title'] = $cate->cate_name.'_'.'秀目录_网站目录_网站分类目录_网站目录_分类目录';
            $data['site_keywords'] = $cate->cate_keywords.','.'秀目录,网站目录,免费网站目录,分类目录,网站分类目录';
            $data['site_description'] = $cate->cate_description.','.'秀目录网站目录是全人工编辑的开放式网站分类目录，收录国内外、各行业优秀网站，免费网站目录,网站分类目录, 网站提交入口。旨在为用户提供优秀网站目录检索、网站推广服务。';
        }else{
            $websites = Website::where('web_status','=','3')->orderBy('web_id','desc')->paginate(12);
            $data['websites'] = $websites;
            $data['site_title'] = '秀目录_网站目录_网站分类目录_网站目录_分类目录';
            $data['site_keywords'] = '秀目录,网站目录,免费网站目录,分类目录,网站分类目录';
            $data['site_description'] = '秀目录网站目录是全人工编辑的开放式网站分类目录，收录国内外、各行业优秀网站，免费网站目录,网站分类目录, 网站提交入口。旨在为用户提供优秀网站目录检索、网站推广服务。';
        }
        $data['pages'] = Page::get();
        $data['art_list'] = $this->art_list;
        $data['site_list'] = $this->site_list;
        $data['site_nav'] = 'webdir';
        return view('front/webdir_lists',$data);
    }
	/**
	 * 站点内容页
	 */
    function info(Request $request)
	{
        $websites = website::leftJoin('users', 'users.id','=','websites.user_id')->where('websites.web_status','=','3')->where('websites.web_id','=',$request->id)->select('websites.*')->first();
        if($websites){
            $data['websites'] = $websites;

            $data['site_title'] = $websites->web_name.$websites->web_url.' - 秀站分类目录分享网站价值';
            $data['site_keywords'] = $websites->web_name.','.$websites->web_tags;
            $data['site_description'] = $websites->web_name.','.$websites->web_intro;

            $data['art_list'] = $this->art_list;
            $data['site_list'] = $this->site_list;
            $data['webtags'] = explode(',',$websites->web_tags);
            $data['pages'] = Page::get();
            $data['site_nav'] = 'webdir';
            $webarray['web_views'] = $websites->web_views+1;
            Website::where('web_id', $request->id)->update($webarray);
            return view('front/webdir_info',$data);
        }else{
            return redirect('/');
        }
    }
	/**
	 * 递归分类目录
	 */
    function cates()
	{
        $array = array();
        $cate = Category::where('cate_mod','webdir')->where('root_id','0')->orderBy('cate_id','asc')->select('cate_name','cate_img','cate_dir','cate_id','cate_arrchildid')->get();
        foreach($cate as $str){
        $cate_data = $str;
        $collects = explode(",",$str->cate_arrchildid);
        $cate_data['site_array'] = Category::orderBy('cate_id','asc')->whereIn('cate_id',$collects)->get();
        $array[] = $cate_data;
        }
        return $array;
    }
}
