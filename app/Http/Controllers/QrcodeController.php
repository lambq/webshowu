<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category, App\Page, App\Article, App\Website, App\Qrcode;

class QrcodeController extends Controller
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
	 * 二维码首页
	 */
    function index(Request $request)
	{
        $data['cates'] = $this->cates();
        $data['site_title'] = '秀二维码_微信群_微信群大全';
        $data['site_keywords'] = '秀二维码,微信群,微信群大全,微信群二维码';
        $data['site_description'] = '秀二维码每天更新发布全国各地各行业的微信群二维码。乃微商和微信粉丝推广爱好者的居家旅行，必备良“站”。';
        $data['pages'] = Page::get();
        $data['site_nav'] = 'qrcode';
        return view('front/qrcode_index',$data);
    }
	/**
	 * 二维码列表
	 */
    function lists(Request $request)
	{
        if(!is_numeric($request->id)){
            $cate = Category::where('cate_dir', $request->id)->first();
            $collects = explode(",",$cate->cate_arrchildid);
            $qrcode = Qrcode::where('qr_status','3')->whereIn('cate_id',$collects)->orderBy('qr_id','desc')->paginate(12);
            $data['qrcode'] = $qrcode;
            $data['site_title'] = $cate->cate_name.'_'.'秀资讯--不一样的资讯网站';
            $data['site_keywords'] = $cate->cate_keywords.','.'秀站长,秀seo,秀运营,秀技术,秀资讯,奇趣科技,不一样的网站';
            $data['site_description'] = $cate->cate_description.','.'秀资讯是一个不一样的资讯网站，每天更新最新站长运营、SEO技术、奇趣科技的文章，是一个值得收藏的网站。';
        }else{
            $qrcode = Qrcode::where('qr_status','3')->orderBy('qr_id','desc')->paginate(12);
            $data['qrcode'] = $qrcode;
            $data['site_title'] = '秀资讯--不一样的资讯网站';
            $data['site_keywords'] = '秀站长,秀seo,秀运营,秀技术,秀资讯,奇趣科技,不一样的网站';
            $data['site_description'] = '秀资讯是一个不一样的资讯网站，每天更新最新站长运营、SEO技术、奇趣科技的文章，是一个值得收藏的网站。';
        }
        $data['pages'] = Page::get();
        $data['art_list'] = $this->art_list;
        $data['site_list'] = $this->site_list;
        $data['site_nav'] = 'qrcode';
        return view('front/qrcode_lists',$data);
    }
    /**
	 * 二维码内容
	 */
    function info(Request $request)
	{
		$qrcode = Qrcode::where('qr_id',$request->id)->where('qr_status','3')->first();
		if($qrcode){
			$data['site_title'] = $qrcode->qr_name.' - 秀站分类目录分享网站价值';
			$data['site_keywords'] = $qrcode->qr_name.','.$qrcode->qr_tags;
			$data['site_description'] = $qrcode->qr_name.','.$qrcode->qr_intro;
			$data['site_nav'] = 'qrcode';
			$data['qrcode'] = $qrcode;
			$data['art_list'] = $this->art_list;
			$data['site_list'] = $this->site_list;
			$data['prev'] = $this->getPrevArticleId($request->id,$qrcode->cate_id);
			$data['next'] = $this->getNextArticleId($request->id,$qrcode->cate_id);
			$data['pages'] = Page::get();
			Qrcode::where('qr_id', $request->id )->update(array('qr_views'=> $qrcode->qr_views+1 ));
		return view('front/qrcode_info',$data);
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
		$cate = Category::where('cate_mod','qrcode')->orderBy('cate_id','desc')->select('cate_name','cate_dir','cate_id','cate_arrchildid')->get();
		foreach($cate as $str){
			$cate_data = $str;
			$collects = explode(",",$str->cate_arrchildid);
			$cate_data['site_array'] = Qrcode::where('qr_status','3')->orderBy('qr_id','desc')->whereIn('cate_id',$collects)->take('6')->get();
			$array[] = $cate_data;
		}
		return $array;
    }
	/**
	 * 上一个
	 */
    protected function getPrevArticleId($id,$cate_id){
        $aid = Qrcode::where('qr_id', '<', $id)->where('qr_status','=','3')->where('cate_id',$cate_id)->max('qr_id');
        return Qrcode::where('qr_id','=',$aid)->first();
    }
	/**
	 * 下一个
	 */
    protected function getNextArticleId($id,$cate_id){
        $aid = Qrcode::where('qr_id', '>', $id)->where('qr_status','=','3')->where('cate_id',$cate_id)->min('qr_id');
        return Qrcode::where('qr_id','=',$aid)->first();
    }
}
