<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\User, App\Article, App\Website, App\Category, Validator, Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->edit_id){
            $art_data['name'] = $request->name;
            $art_data['user_qq'] = $request->user_qq;
            User::where('user_id', $request->user()->id )->update($art_data);
            return redirect::to('profile')->with('success','个人资料修改成功！');
        }
        $data['pagename'] = '个人信息 - 会员中心';
        $data['site_title'] = '个人信息 - 会员中心 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '个人信息 - 会员中心 - 秀站分类目录分享网站价值';
        $data['site_description'] = '个人信息 - 会员中心 - 秀站分类目录分享网站价值';
        $data['site_nav'] = 'index';

        $data['myself'] = $request->user();
        return view('home/index',$data);
    }
    /**
     * 站点列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get_site(Request $request)
	  {
        $data['pagename'] = '我的站点';
        $data['site_title'] = '我的站点 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '';
        $data['site_description'] = '';
        $data['site_nav'] = 'Website';

        $websites = Website::where('user_id','=', $request->user()->id )->orderBy('updated_at','desc')->paginate(5);
        $data['websites'] = $websites;
        $data['myself'] = $request->user();
        return view('home/get_site',$data);
    }
    /**
     * 站点添加
     *
     * @return \Illuminate\Http\Response
     */
    public function add_site_get(Request $request)
	  {
        $data['pagename'] = '添加新的站点';
        $data['site_title'] = '添加新的站点 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '';
        $data['site_description'] = '';
        $data['site_nav'] = 'Website';

        $data['category_option'] = $this->get_category_option('webdir', 0, 0, 0);
        $data['myself'] = $request->user();
        return view('home/site_add',$data);
    }
    /**
     * 站点添加
     *
     * @return \Illuminate\Http\Response
     */
    public function add_site_post(Request $request)
	  {
        $rules = [
        'web_url' => 'required|active_url',
        'web_name' => 'required',
        'cate_id' => 'required',
        'web_intro' => 'required',
        ];
        $messages = [
        'web_url.required' => '请输入网站域名！',
        'web_url.active_url' => '请输入正确的网站域名！',
        'web_name.required' => '请输入网站名称！',
        'cate_id.required' => '请选择网站所属分类！',
        'web_intro.required' => '请输入网站简介！',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $cate = Category::where('cate_id', $request->cate_id)->first();
        if ($cate['cate_childcount'] > 0) {
            return redirect::back()->withErrors('指定的分类下有子分类，请选择子分类进行操作！');
        }

        if(!empty($request->web_tags)) {
            $request->web_tags = str_replace('/', ',', $request->web_tags);
            $request->web_tags = str_replace('|', ',', $request->web_tags);
            $request->web_tags = str_replace('|', ',', $request->web_tags);
            $request->web_tags = str_replace('，', ',', $request->web_tags);
            $request->web_tags = str_replace(',,', ',', $request->web_tags);
            if (substr($request->web_tags, -1) == ',') {
                $request->web_tags = substr($request->web_tags, 0, strlen($request->web_tags) - 1);
            }
        }

        $weburl = Website::where('web_url', $request->web_url)->first();
        if($weburl) {
        return redirect::back()->withErrors('您所提交的网站已存在！');
        }

        $web_ip = sprintf("%u", ip2long($request->getClientIp()));
        $data = new Website;
        $data->cate_id = $request->cate_id;
        $data->user_id = $request->user()->id;
        $data->web_name = $request->web_name;
        $data->web_url = $request->web_url;
        $data->web_tags = $request->web_tags;
        $data->web_intro = $request->web_intro;
        $data->web_ip = $web_ip;
        $data->web_grank = $request->web_grank;
        $data->web_brank = $request->web_brank;
        $data->web_srank = $request->web_srank;
        $data->web_arank = $request->web_arank;
        $data->web_status = '2';
        $data->save();
        return redirect('/get_site');
    }
    /**
     * 站点编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_site_get(Request $request)
		{
        $data['pagename'] = '站点编辑';
        $data['site_title'] = '站点编辑 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '';
        $data['site_description'] = '';
        $data['site_nav'] = 'Website';


        $web = Website::where('web_id', $request->id )->where('user_id', $request->user()->id)->first();
        $data['category_option'] = $this->get_category_option('webdir', 0, $web->cate_id , 0);
        $data['myself'] = $request->user();
        $data['edit_id'] = $request->id;
        $data['web'] = $web;
        return view('home/site_edit',$data);
    }
    /**
     * 站点编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_site_post(Request $request)
		{
        $rules = [
        'web_url' => 'required|active_url',
        ];
        $messages = [
        'web_url.required' => '请输入网站域名！',
        'web_url.active_url' => '请输入正确的网站域名！',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if(!$request->cate_id){
            return redirect::back()->withErrors('请选择网站所属分类！');
        }else{
            $cate = Category::where('cate_id', $request->cate_id)->first();
            if ($cate['cate_childcount'] > 0) {
                return redirect::back()->withErrors('指定的分类下有子分类，请选择子分类进行操作！');
            }
        }

        if(empty($request->web_name)) {
            return redirect::back()->withErrors('请输入网站名称！');
        }

        if(!empty($request->web_tags)) {
            $request->web_tags = str_replace('/', ',', $request->web_tags);
            $request->web_tags = str_replace('|', ',', $request->web_tags);
            $request->web_tags = str_replace('|', ',', $request->web_tags);
            $request->web_tags = str_replace('，', ',', $request->web_tags);
            $request->web_tags = str_replace(',,', ',', $request->web_tags);
            if (substr($request->web_tags, -1) == ',') {
                $request->web_tags = substr($request->web_tags, 0, strlen($request->web_tags) - 1);
            }
        }

        if(empty($request->web_intro)) {
            return redirect::back()->withErrors('请输入网站简介！');
        }

        $web_ip = sprintf("%u", ip2long($request->getClientIp()));

        $web_site['cate_id'] = $request->cate_id;
        $web_site['web_name'] = $request->web_name;
        $web_site['web_url'] = $request->web_url;
        $web_site['web_tags'] = $request->web_tags;
        $web_site['web_intro'] = $request->web_intro;
        $web_site['web_ip'] = $request->web_ip;
        $web_site['web_grank'] = $request->web_grank;
        $web_site['web_brank'] = $request->web_brank;
        $web_site['web_srank'] = $request->web_srank;
        $web_site['web_arank'] = $request->web_arank;
        $web_site['web_status'] = '2';
        Website::where('web_id', $request->edit_id)->where('user_id', $request->user()->id)->update($web_site);
        return redirect('/get_site');
    }
    /**
     * 文章列表
     *
     * @return \Illuminate\Http\Response
     */
    public function get_art(Request $request)
		{
        $data['pagename'] = '我的投稿';
        $data['site_title'] = '我的投稿 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '';
        $data['site_description'] = '';
        $data['site_nav'] = 'Article';

        $articles = Article::where('user_id','=', $request->user()->id )->orderBy('updated_at','desc')->paginate(15);
        $data['articles'] = $articles;
        $data['myself'] = $request->user();
        return view('home/get_art',$data);
    }
    /**
     * 文章添加
     *
     * @return \Illuminate\Http\Response
     */
    public function add_art_get(Request $request)
		{
        $data['pagename'] = '发布文章';
        $data['site_title'] = '发布文章 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '';
        $data['site_description'] = '';
        $data['site_nav'] = 'Article';

        $data['category_option'] = $this->get_category_option('article', 0, 0, 0);
        $data['myself'] = $request->user();
        return view('home/art_add',$data);
    }
    /**
     * 文章添加
     *
     * @return \Illuminate\Http\Response
     */
    public function add_art_post(Request $request)
		{
        $rules = [
        'art_title' => 'required',
        'art_tags' => 'required',
        'art_intro' => 'required',
        'art_content' => 'required',
        ];
        $messages = [
        'art_title.required' => '请输入文章标题',
        'art_tags.required' => '请输入TAG标签',
        'art_intro.required' => '请输入内容摘要',
        'art_content.required' => '请输入文章内容',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $cate = Category::where('cate_id', $request->cate_id)->first();
        if ($cate['cate_childcount'] > 0) {
            return redirect::back()->withErrors('指定的分类下有子分类，请选择子分类进行操作！');
        }

        if (!empty($request->art_tags)) {
          $request->art_tags = str_replace('/', ',', $request->art_tags);
          $request->art_tags = str_replace('|', ',', $request->art_tags);
          $request->art_tags = str_replace('|', ',', $request->art_tags);
          $request->art_tags = str_replace('，', ',', $request->art_tags);
          $request->art_tags = str_replace(',,', ',', $request->art_tags);
          if (substr($request->art_tags, -1) == ',') {
            $request->art_tags = substr($request->art_tags, 0, strlen($request->art_tags) - 1);
          }
        }

        if (empty($request->copy_from)) $request->copy_from = '本站原创';

        if (empty($request->copy_url)) $request->copy_url = 'http://www.webshowu.com';

        $art_title = Article::where('art_title', $request->art_title)->first();
        if($art_title) {
            return redirect::back()->withErrors('您所发布的文章已存在！');
        }

        $data = new Article;
        $data->user_id = $request->user()->id ;
        $data->cate_id = $request->cate_id;
        $data->art_title = $request->art_title;
        $data->art_tags = $request->art_tags;
        $data->copy_from = $request->copy_from;
        $data->copy_url = $request->copy_url;
        $data->art_intro = $request->art_intro;
        $data->art_content = $request->art_content;
        $data->art_status = '2';
        $data->save();
        return redirect('/get_art');
    }
    /**
     * 文章编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_art_get(Request $request)
		{
        $data['pagename'] = '编辑文章';
        $data['site_title'] = '编辑文章 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '';
        $data['site_description'] = '';
        $data['site_nav'] = 'Article';

        $row = Article::where('art_id', $request->id)->where('user_id', $request->user()->id)->first();
        $data['category_option'] = $this->get_category_option('article', 0, $row->cate_id, 0);
        $data['myself'] = $request->user();
        $data['edit_id'] = $request->id;
        $data['row'] = $row;
        return view('home/art_edit',$data);
    }
    /**
     * 文章编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_art_post(Request $request)
		{
        $rules = [
          'art_title' => 'required',
          'art_tags' => 'required',
          'art_intro' => 'required',
          'art_content' => 'required',
        ];
        $messages = [
          'art_title.required' => '请输入文章标题',
          'art_tags.required' => '请输入TAG标签',
          'art_intro.required' => '请输入内容摘要',
          'art_content.required' => '请输入文章内容',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $cate = Category::where('cate_id', $request->cate_id)->first();
        if ($cate['cate_childcount'] > 0) {
            return redirect::back()->withErrors('指定的分类下有子分类，请选择子分类进行操作！');
        }

        if (!empty($request->art_tags)) {
            $request->art_tags = str_replace('/', ',', $request->art_tags);
            $request->art_tags = str_replace('|', ',', $request->art_tags);
            $request->art_tags = str_replace('|', ',', $request->art_tags);
            $request->art_tags = str_replace('，', ',', $request->art_tags);
            $request->art_tags = str_replace(',,', ',', $request->art_tags);
            if (substr($request->art_tags, -1) == ',') {
                $request->art_tags = substr($request->art_tags, 0, strlen($request->art_tags) - 1);
            }
        }

        if (empty($request->copy_from)) $request->copy_from = '本站原创';

        if (empty($request->copy_url)) $request->copy_url = 'http://www.webshowu.com';

        $art_data['cate_id'] = $request->cate_id;
        $art_data['art_title'] = $request->art_title;
        $art_data['art_tags'] = $request->art_tags;
        $art_data['copy_from'] = $request->copy_from;
        $art_data['copy_url'] = $request->copy_url;
        $art_data['art_intro'] = $request->art_intro;
        $art_data['art_content'] = $request->art_content;
        $art_data['art_status'] = '2';

        Article::where('art_id', $request->edit_id)->where('user_id', $request->user()->id)->update($art_data);
        return redirect('/get_art');
    }
    /**
     * 分类数据
     *
     * @return \Illuminate\Http\Response
     */
    function get_category_option($cate_mod = 'webdir', $root_id = 0, $cate_id = 0, $level_id = 0)
		{
        if (!in_array($cate_mod, array('webdir', 'article'))) $cate_mod = 'webdir';
        $results = Category::where('root_id', $root_id )->where('cate_mod', $cate_mod )->orderBy('cate_order','asc')->orderBy('cate_id','asc')->get();
        $optstr = '';
        foreach ($results as $row) {
            $optstr .= '<option value="'.$row->cate_id.'"';
            if ($cate_id > 0 && $cate_id == $row->cate_id) $optstr .= ' selected';

            if ($level_id == 0) {
              $optstr .= ' style="background: #EEF3F7;">';
              $optstr .= '├'.$row->cate_name;
            } else {
              $optstr .= '>';
              for ($i = 2; $i <= $level_id; $i++) {
                $optstr .= '│&nbsp;&nbsp;';
              }
              $optstr .= '│&nbsp;&nbsp;├'.$row->cate_name;
            }
            $optstr .= '</option>';
            $optstr .= $this->get_category_option($cate_mod, $row->cate_id, $cate_id, $level_id + 1);
        }
        unset($results);
        return $optstr;
    }
}
