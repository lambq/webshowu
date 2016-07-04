<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category, App\Page, App\Article, App\Website;

class ArticleController extends Controller
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
	 * 文章首页
	 */
    function index(Request $request)
	{
        $data['cates'] = $this->cates();
        $data['site_title'] = '秀资讯--不一样的资讯网站';
        $data['site_keywords'] = '秀站长,秀seo,秀运营,秀技术,秀资讯,奇趣科技,不一样的网站';
        $data['site_description'] = '秀资讯是一个不一样的资讯网站，每天更新最新站长运营、SEO技术、奇趣科技的文章，是一个值得收藏的网站。';
        $data['pages'] = Page::get();
        $data['site_nav'] = 'article';
        return view('front/article_index',$data);
    }
	/**
	 * 文章列表
	 */
    function lists(Request $request)
	{
        if(!is_numeric($request->id)){
            $cate = Category::where('cate_dir', $request->id)->first();
            $collects = explode(",",$cate->cate_arrchildid);
            $articles = Article::where('art_status','3')->whereIn('cate_id',$collects)->orderBy('art_id','desc')->paginate(10);
            $data['articles'] = $articles;
            $data['site_title'] = $cate->cate_name.'_'.'秀资讯--不一样的资讯网站';
            $data['site_keywords'] = $cate->cate_keywords.','.'秀站长,秀seo,秀运营,秀技术,秀资讯,奇趣科技,不一样的网站';
            $data['site_description'] = $cate->cate_description.','.'秀资讯是一个不一样的资讯网站，每天更新最新站长运营、SEO技术、奇趣科技的文章，是一个值得收藏的网站。';
        }else{
            $articles = Article::where('art_status','3')->orderBy('art_id','desc')->paginate(10);
            $data['articles'] = $articles;
            $data['site_title'] = '秀资讯--不一样的资讯网站';
            $data['site_keywords'] = '秀站长,秀seo,秀运营,秀技术,秀资讯,奇趣科技,不一样的网站';
            $data['site_description'] = '秀资讯是一个不一样的资讯网站，每天更新最新站长运营、SEO技术、奇趣科技的文章，是一个值得收藏的网站。';
        }
        $data['pages'] = Page::get();
        $data['art_list'] = $this->art_list;
        $data['site_list'] = $this->site_list;
        $data['site_nav'] = 'article';
        return view('front/article_lists',$data);
    }
	/**
	 * 文章内容
	 */
    function info(Request $request)
	{
        $articles = Article::where('art_id',$request->id)->where('art_status','3')->first();
        if($articles){
            $data['articles'] = $articles;

            $data['site_title'] = $articles->art_title.' - 秀站分类目录分享网站价值';
            $data['site_keywords'] = $articles->art_title.','.$articles->art_tags;
            $data['site_description'] = $articles->art_title.','.$articles->art_intro;

            $data['art_list'] = $this->art_list;
            $data['site_list'] = $this->site_list;

            $data['prev'] = $this->getPrevArticleId($request->id,$articles->cate_id);
            $data['next'] = $this->getNextArticleId($request->id,$articles->cate_id);
            $data['arttags'] = explode(',',$articles->art_tags);
            $data['pages'] = Page::get();
            $data['site_nav'] = 'article';
            $art_data['art_views'] = $articles->art_views+1;
            Article::where('art_id', $request->id)->update($art_data);
            return view('front/article_info',$data);
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
        $cate = Category::where('cate_mod','article')->orderBy('cate_id','desc')->select('cate_name','cate_dir','cate_id','cate_arrchildid')->get();
        foreach($cate as $str){
            $cate_data = $str;
            $collects = explode(",",$str->cate_arrchildid);
            $cate_data['site_array'] = Article::where('art_status','3')->orderBy('art_id','desc')->whereIn('cate_id',$collects)->select('art_id','art_title as title','art_intro as intro','updated_at','art_tags as tags','art_content as content')->take('6')->get();
            $array[] = $cate_data;
        }
        return $array;
    }
	/**
	 * 上一个
	 */
    protected function getPrevArticleId($id,$cate_id){
        $aid = Article::where('art_id', '<', $id)->where('art_status','=','3')->where('cate_id',$cate_id)->max('art_id');
        return Article::where('articles.art_id','=',$aid)->first();
    }
	/**
	 * 下一个
	 */
    protected function getNextArticleId($id,$cate_id){
        $aid = Article::where('art_id', '>', $id)->where('art_status','=','3')->where('cate_id',$cate_id)->min('art_id');
        return Article::where('articles.art_id','=',$aid)->first();
    }
}