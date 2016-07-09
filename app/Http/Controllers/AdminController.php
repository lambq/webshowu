<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Libraries\BearyChatRobot; //机器人通知

use Auth, Mail, App\Website, App\Category, App\User, Validator, Redirect, Carbon\Carbon, Storage;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
		/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
		public function index(Request $request)
		{
				//BearyChatRobot::notify('有人登陆了后台了', '用户：xxxx'); 程序输出到机器人中！出现错误了！然后自己报警
				//print_r($request);die();
				$data['pagename'] = '后台管理——首页';
        $data['site_title'] = '后台管理 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '后台管理 - 秀站分类目录分享网站价值';
        $data['site_description'] = '后台管理 - 秀站分类目录分享网站价值';
        $data['site_nav'] = '主页';

        $data['myself'] = $request->user();
				return view('admin/index',$data);
		}
		/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
		public function webdir(Request $request)
		{
				$data['pagename'] = '后台管理——首页';
				$data['site_title'] = '后台管理 - 秀站分类目录分享网站价值';
				$data['site_keywords'] = '后台管理 - 秀站分类目录分享网站价值';
				$data['site_description'] = '后台管理 - 秀站分类目录分享网站价值';
				$data['site_nav'] = '秀目录';

				$websites = Website::where('web_status', '2')->orderBy('updated_at','desc')->paginate(5);
        $data['websites'] = $websites;
				$data['myself'] = $request->user();
				return view('admin/webdir',$data);
		}
		/**
     * 站点编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_webdir_get(Request $request)
		{
        $data['pagename'] = '站点编辑';
        $data['site_title'] = '站点编辑 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '';
        $data['site_description'] = '';
        $data['site_nav'] = 'Website';


        $web = Website::where('web_id', $request->id )->first();
        $data['category_option'] = $this->get_category_option('webdir', 0, $web->cate_id , 0);
        $data['myself'] = $request->user();
        $data['edit_id'] = $request->id;
        $data['web'] = $web;
        return view('admin/webdir_edit',$data);
    }
		/**
     * 站点编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_webdir_post(Request $request)
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
        $web_site['web_status'] = '3';
        Website::where('web_id', $request->edit_id)->update($web_site);
				
				$user = User::where('id', $request->user_id )->first();
				$maildate = ['web_id'=> $request->edit_id,'name'=> $user->name,'web_url'=> $request->web_url,'uptime'=> Carbon::now() ,'web_name'=> $request->web_name,'imgPath'=> 'http://7xty0v.com1.z0.glb.clouddn.com/fluidicon.png'];
				Mail::send('emails.mail_shenhe_webdir', $maildate , function ($m) use ($user,$web_site) {
            $m->from('wwwwebshowucom@rushangkeji.com', '秀站分类目录');
						$m->to($user->email, $user->name )->subject('[秀站分类目录]'.$web_site['web_url'].'审核反馈通知：已经通过');
        });
				zhanzhang_push_baidu("http://www.webshowu.com/siteinfo-". $request->edit_id .".html");
        return redirect('/admin/webdir');
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
