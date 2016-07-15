<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article, App\Website, App\Link, App\Lable, App\Category, App\Page;

class IndexController extends Controller
{
		/**
     * 首页
     *
     * @return void
     */
    public function index(Request $request)
		{
        $data['site_title'] = '秀站分类目录|中文分类目录|网站分类目录|免费网站目录|dmoz目录-北京儒尚科技有限公司';
        $data['site_keywords'] = 'DMOZ目录,DMOZ分类目录,网站收录,网站目录,网站登录,中文网站目录,秀站分类目录,分类目录,秀站分类目录分享网站价值,秀站,秀站目录,免费网站目录';
        $data['site_description'] = '秀站分类目录免费收录各类优秀中文网站，提供网站分类目录检索，关键字搜索，提供网站即可免费快速提升网站流量，分享网站价值也是中国dmoz的标志';
        $data['articles'] = Article::where(['art_status'=>'3'])->orderBy('updated_at','desc')->take('5')->get();
        $data['websites'] = Website::where(['web_status'=>'3'])->orderBy('web_isbest','desc')->orderBy('updated_at','desc')->take('5')->get();
        $data['hotsites'] = Website::where(['web_status'=>'3'])->orderBy('updated_at','desc')->take('5')->get();
        $data['links'] = Link::where(['link_hide'=>'1'])->orderBy('link_order','asc')->get();
        $data['lables'] = Lable::where(['cate_mod'=>'webdir'])->orderBy('lab_views','desc')->take('30')->get();
        $data['cates'] = $this->cates();
        $data['pages'] = Page::get();
        $data['success'] = 'xiumei';
        $data['site_nav'] = 'index';
        $success = false;//$this->xiumeiProxy($request);
        if($success){
          $data['success'] = $success;
        }
        return view('front/index',$data);
    }
		/**
     * 标签
     *
     * @return void
     */
    public function tags(Request $request)
		{
        return redirect('/');
        /*
        $lables = Lables::where('lab_name',$request->str )->first();
        if($lables){
        $data['site_title'] = $lables->lab_name.'-秀站分类目录分享网站价值';
        $data['site_keywords'] = $lables->lab_tags.',秀站分类目录';
        $data['site_description'] = $lables->lab_intro.'-秀站分类目录分享网站价值';
        $data['lablist'] = Websites::where(['web_status'=>'3'])->where('web_tags','like',"%$lables->lab_name%")->paginate(15);
        $data['pages'] = Pagelist::get();
        $webarray['lab_views'] = $lables->lab_views+1;
        Lables::where('lab_name',  $request->str )->update($webarray);
        return view('front/tags',$data);
        }else{
        return redirect('/');
        }
        */
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
            return view('front/diypage',$data);
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
      $cate = Category::where(['cate_isbest'=>'1'])->orderBy('cate_order','asc')->orderBy('cate_id','asc')->get();
      foreach($cate as $str){
        $cate_data['cate_name'] = $str->cate_name;
        $cate_data['cate_id'] = $str->cate_id;
        $collects = explode(",",$str->cate_arrchildid);
        $cate_data['site_array'] = Website::leftJoin('users', 'users.id','=','websites.user_id')->where('websites.web_status','3')->where('websites.web_ispay','1')->whereIn('websites.cate_id',$collects)->orderBy('websites.updated_at','desc')->take('6')->get();
        $array[] = $cate_data;
      }
      return $array;
    }
		/**
     * 基于反向链接
     *
     * @return void
     */
    public function xiumeiProxy($request)
		{
        if($request->server('HTTP_REFERER') && !str_contains($request->server('HTTP_REFERER'),'webshowu')){
            $app_url = $this->xiumeiParseUrl($request->server('HTTP_REFERER'));
            $array = Website::where('web_url','like','%'.$app_url.'%')->first();
            if(!$array){
                if(get_url_content('http://'.$app_url)){
                    $this->xiumeiAdd($app_url);
                    $this->dispatch(new Xiumei($app_url));
                    return '基于反向链接已经把网址：'.$app_url.'添加到列队中……请稍等！秀妹正在给您处理中……';
                }else{
                    return '您的网站秀妹访问不到！及时处理请加入QQ群：57176386';
                }
            }else{
              if($array['web_status'] == '1'){
                  $this->dispatch(new Xiumei($app_url));
                  if($array['web_ispay'] == '0'){
                      return '秀站在'.$array['updated_at'].'处理过您的站点发现没有秀站分类目录的友情链接&nbsp;请把链接添加上，秀妹会给你下一步处理的';
                  }
                  return '秀妹正在获取您站点：'.$app_url.'的信息&nbsp;请稍等……';
              }else{
                  $websites = Website::where('web_id',$array->web_id)->first();
                  $webarray['web_views'] = $websites->web_views+1;
                  Website::where('web_id', $websites->web_id)->update($webarray);
                  return false;
              }
            }
        }
        return false;
    }
    public function xiumeiAdd($url)
		{
        $data = new Website;
        $data->cate_id = '10000';
        $data->user_id = '10000';
        $data->web_name = '';
        $data->web_url = $url;
        $data->web_tags = '';
        $data->web_intro = '';
        $data->web_status = '1';
        $data->save();
    }
    public function xiumeiParseUrl($url,$type=0)
		{
        if($type == 0){
            $array = parse_url($url);
            return $array['host'];
        }
        return false;
    }
}
