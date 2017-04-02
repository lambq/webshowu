<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Article;
use App\Models\Page;
use App\Models\Categorie;
use App\Models\Website;
use App\Models\Link;
use Lambq\Sdk\Facades\BaiduPushZZ;
use Redirect;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * OperateController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        //BearyChatRobot::notify('有人登陆了后台了', '用户：xxxx'); 程序输出到机器人中！出现错误了！然后自己报警
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '后台管理 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '后台管理 - 秀站分类目录分享网站价值';
        $data['site_description'] = '后台管理 - 秀站分类目录分享网站价值';
        $data['site_nav'] = '主页';

        $data['myself'] = $request->user('admin');
        return view('admin.index',$data);
    }

    /**
     * 管理后台 秀菜单管理列表
     *
     * @return \Illuminate\Http\Response
     */
    public function menu_index(Request $request)
    {
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '秀菜单管理 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '秀菜单管理 - 秀站分类目录分享网站价值';
        $data['site_description'] = '秀菜单管理 - 秀站分类目录分享网站价值';
        $data['site_nav'] = '秀菜单管理列表';

        $data['myself'] = $request->user('admin');
        return view('admin.menu_index',$data);
    }

    /**
     * 管理后台 秀友链管理列表
     *
     * @return \Illuminate\Http\Response
     */
    public function link_index(Request $request)
    {
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '秀友链管理 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '秀友链管理 - 秀站分类目录分享网站价值';
        $data['site_description'] = '秀友链管理 - 秀站分类目录分享网站价值';
        $data['site_nav'] = '秀友链管理';

        $Link = Link::orderBy('updated_at','desc')->paginate(5);
        $data['link'] = $Link;
        $data['myself'] = $request->user('admin');
        return view('admin.link_index',$data);
    }

    /**
     * 管理后台 秀友链管理编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function link_edit(Request $request)
    {
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '秀友链编辑 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '秀友链编辑';
        $data['site_description'] = '秀友链编辑';
        $data['site_nav'] = '秀友链编辑';


        $link = Link::where('link_id', $request->id )->first();
        $data['link'] = $link;
        $data['myself'] = $request->user('admin');
        return view('admin.link_edit',$data);
    }

    /**
     * 管理后台 秀友链管理编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function link_update(Request $request)
    {
        $rules = [
            'link_name' => 'required',
            'link_url' => 'required',
            'link_hide' => 'required',
            'link_order' => 'required',
        ];
        $messages = [
            'link_name.required' => '请输入链接名称！',
            'link_url.required' => '请输入链接地址！',
            'link_hide.required' => '请输入链接状态！',
            'link_order.required' => '请输入链接排序！',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        Link::where('link_id', $request->edit_id)->update([
            'link_name'     => $request->link_name,
            'link_url'      => $request->link_url,
            'link_logo'     => $request->link_logo,
            'link_hide'     => $request->link_hide,
            'link_order'    => $request->link_order,
        ]);

        return redirect::to('link')->with('success', $request->link_url.'已经修改成功了！');
    }

    /**
     * 管理后台 秀目录管理列表
     *
     * @return \Illuminate\Http\Response
     */
    public function webdir_index(Request $request)
    {
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '秀目录管理 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '秀目录管理 - 秀站分类目录分享网站价值';
        $data['site_description'] = '秀目录管理 - 秀站分类目录分享网站价值';
        $data['site_nav'] = '秀目录管理';
        if($request->web_url != ''){
            $websites = Website::where('web_url', $request->web_url)->orderBy('web_id','desc')->paginate(5);
        }
        if($request->tag == 0 && $request->web_url == ''){
            $websites = Website::orderBy('web_id','desc')->paginate(5);
        }
        if($request->tag == 1 && $request->web_url == ''){
            $websites = Website::where('web_status', 2)->orderBy('web_id','desc')->paginate(5);
        }
        if($request->tag == 2 && $request->web_url == ''){
            $websites = Website::where('web_status', 3)->orderBy('web_id','desc')->paginate(5);
        }
        if($request->tag == 3 && $request->web_url == ''){
            $websites = Website::where('web_ispay', 0)->orderBy('web_id','desc')->paginate(5);
        }
        if($request->tag == 4 && $request->web_url == ''){
            $websites = Website::where('web_ispay', 1)->orderBy('web_id','desc')->paginate(5);
        }
        if($request->tag == 5 && $request->web_url == ''){
            $websites = Website::where('web_isbest', 1)->orderBy('web_id','desc')->paginate(5);
        }
        if($request->tag == 6 && $request->web_url == ''){
            $websites = Website::where(['web_istop'=>0,'web_status'=>3])->orderBy('web_id','desc')->paginate(5);
        }
        $data['web_url']   = $request->web_url?$request->web_url:'';
        $data['websites']   = $websites;
        $data['myself']     = $request->user('admin');
        $data['tag']        = $request->tag;
        return view('admin.webdir_index',$data);
    }

    /**
     * 管理后台 秀目录管理编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function webdir_edit(Request $request)
    {
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '秀目录编辑 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '秀目录编辑';
        $data['site_description'] = '秀目录编辑';
        $data['site_nav'] = '秀目录编辑';


        $web = Website::where('web_id', $request->id )->first();
        $data['category_option'] = $this->get_category_option('webdir', 0, $web->cate_id , 0);
        $data['edit_id'] = $request->id;
        $data['web'] = $web;
        $data['myself'] = $request->user('admin');
        return view('admin.webdir_edit',$data);
    }

    /**
     * 管理后台 秀目录管理更新
     *
     * @return \Illuminate\Http\Response
     */
    public function webdir_update(Request $request)
    {
        $rules = [
            'web_url' => 'required',
        ];
        $messages = [
            'web_url.required' => '请输入网站域名！',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        if(!$request->cate_id){
            return redirect::back()->withInput($request->all())->withErrors('请选择网站所属分类！');
        }else{
            $cate = Categorie::where('cate_id', $request->cate_id)->first();
            if ($cate['cate_childcount'] > 0) {
                return redirect::back()->withInput($request->all())->withErrors('指定的分类下有子分类，请选择子分类进行操作！');
            }
        }

        if(empty($request->web_name)) {
            return redirect::back()->withInput($request->all())->withErrors('请输入网站名称！');
        }

        if(!empty($request->web_tags)) {
            $request->web_tags = str_replace('/', ',', $request->web_tags);
            $request->web_tags = str_replace('|', ',', $request->web_tags);
            $request->web_tags = str_replace('|', ',', $request->web_tags);
            $request->web_tags = str_replace('，', ',', $request->web_tags);
            $request->web_tags = str_replace(',,', ',', $request->web_tags);
            $request->web_tags = str_replace('、', ',', $request->web_tags);
            $request->web_tags = str_replace(' ', ',', $request->web_tags);
            if (substr($request->web_tags, -1) == ',') {
                $request->web_tags = substr($request->web_tags, 0, strlen($request->web_tags) - 1);
            }
        }

        if(empty($request->web_intro)) {
            return redirect::back()->withInput($request->all())->withErrors('请输入网站简介！');
        }

        $request->web_ip = sprintf("%u", ip2long($request->getClientIp()));

        $web_site   = [
            'cate_id'       => $request->cate_id,
            'web_name'      => $request->web_name,
            'web_url'       => $request->web_url,
            'web_tags'      => $request->web_tags,
            'web_intro'     => $request->web_intro,
            'web_ip'        => $request->web_ip,
            'web_grank'     => $request->web_grank,
            'web_brank'     => $request->web_brank,
            'web_srank'     => $request->web_srank,
            'web_arank'     => $request->web_arank,
            'web_ispay'     => $request->web_ispay?$request->web_ispay:0,
            'web_istop'     => $request->web_istop?$request->web_istop:0,
            'web_isbest'    => $request->web_isbest?$request->web_isbest:0,
            'web_status'    => $request->web_status,
        ];
        Website::where('web_id', $request->edit_id)->update($web_site);

//        $user = User::where('id', $request->user_id )->first();
//        $maildate = [
//            'web_id'=> $request->edit_id,
//            'name'=> $user->name,
//            'web_url'=> $request->web_url,
//            'uptime'=> Carbon::now() ,
//            'web_name'=> $request->web_name,'imgPath'=> 'http://7xty0v.com1.z0.glb.clouddn.com/fluidicon.png'
//        ];
//        Mail::send('emails.mail_shenhe_webdir', $maildate , function ($m) use ($user,$web_site) {
//            $m->from('wwwwebshowucom@rushangkeji.com', '秀站分类目录');
//            $m->to($user->email, $user->name )->subject('[秀站分类目录]'.$web_site['web_url'].'审核反馈通知：已经通过');
//        });
        $BaiduPushZZ    = new BaiduPushZZ();
        $BaiduPushZZ->push(["http://www.webshowu.com/siteinfo-". $request->edit_id .".html"]);
        return redirect::back()->withInput($request->all())->with('success', $request->web_url.'已经修改成功！');
    }

    /**
     * 管理后台 秀资讯管理列表
     *
     * @return \Illuminate\Http\Response
     */
    public function article_index(Request $request){
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '秀资讯管理 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '秀资讯管理 - 秀站分类目录分享网站价值';
        $data['site_description'] = '秀资讯管理 - 秀站分类目录分享网站价值';
        $data['site_nav'] = '秀资讯管理';
        if($request->tag == 0){
            $article = Article::orderBy('art_id','desc')->paginate(5);
        }
        if($request->tag == 1){
            $article = Article::where('art_status', 2)->orderBy('art_id','desc')->paginate(5);
        }
        if($request->tag == 2){
            $article = Article::where('art_status', 3)->orderBy('art_id','desc')->paginate(5);
        }
        if($request->tag == 3){
            $article = Article::where('art_ispay', 0)->orderBy('art_id','desc')->paginate(5);
        }
        if($request->tag == 4){
            $article = Article::where('art_ispay', 1)->orderBy('art_id','desc')->paginate(5);
        }
        if($request->tag == 5){
            $article = Article::where('art_isbest', 1)->orderBy('art_id','desc')->paginate(5);
        }
        if($request->tag == 6){
            $article = Article::where(['art_istop'=>0,'art_status'=>3])->orderBy('art_id','desc')->paginate(5);
        }
        $data['article']    = $article;
        $data['tag']        = $request->tag;
        $data['myself']     = $request->user('admin');
        return view('admin.article_index',$data);
    }

    /**
     * 管理后台 帮助文档管理列表
     *
     * @return \Illuminate\Http\Response
     */
    public function pages_index(Request $request){
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '帮助文档管理 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '帮助文档管理 - 秀站分类目录分享网站价值';
        $data['site_description'] = '帮助文档管理 - 秀站分类目录分享网站价值';
        $data['site_nav'] = '帮助文档管理';

        $pages = Page::orderBy('page_id','desc')->paginate(5);

        $data['pages']    = $pages;
        $data['myself']     = $request->user('admin');
        return view('admin.pages_index',$data);
    }

    /**
     * 管理后台 帮助文档管理编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function pages_edit(Request $request){
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '帮助文档管理 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '帮助文档管理';
        $data['site_description'] = '帮助文档管理';
        $data['site_nav'] = '帮助文档管理';

        $pages                  = Page::where('page_id', $request->id )->first();
        $data['edit_id']        = $request->id;
        $data['pages']          = $pages;
        $data['myself']         = $request->user('admin');
        return view('admin.pages_edit',$data);
    }

    /**
     * 管理后台 帮助文档管理更新
     *
     * @return \Illuminate\Http\Response
     */
    public function pages_update(Request $request){
        $rules = [
            'page_name'     => 'required',
            'page_content'     => 'required',
        ];
        $messages = [
            'page_name.required' => '请输入文章标题！',
            'page_content.required' => '请填写文章内容！',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        Page::where('page_id', $request->edit_id)->update([
            'page_name'         => $request->page_name,
            'page_content'      => $request->page_content,
        ]);

        return redirect::back()->withInput($request->all())->with('success', $request->page_name.'已经修改成功！');
    }

    /**
     * 管理后台 秀资讯管理编辑
     *
     * @return \Illuminate\Http\Response
     */
    public function article_edit(Request $request)
    {
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '秀资讯编辑 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '秀资讯编辑';
        $data['site_description'] = '秀资讯编辑';
        $data['site_nav'] = '秀资讯编辑';


        $article = Article::where('art_id', $request->id )->first();
        $data['category_option']    = $this->get_category_option('article', 0, $article->cate_id , 0);
        $data['edit_id']            = $request->id;
        $data['article']            = $article;
        $data['myself']             = $request->user('admin');
        return view('admin.article_edit',$data);
    }

    /**
     * 管理后台 秀资讯管理更新
     *
     * @return \Illuminate\Http\Response
     */
    public function article_update(Request $request){
        $rules = [
            'art_title'     => 'required',
            'copy_from'     => 'required',
//            'org_url'     => 'required',
            'copy_url'     => 'required',
            'art_tags'     => 'required',
            'art_intro'     => 'required',
            'art_content'     => 'required',
            'art_status'     => 'required'
        ];
        $messages = [
            'art_title.required' => '请输入文章标题！',
            'copy_from.required' => '请输入来源名称！',
//            'org_url.required' => '请输入采集地址！',
            'copy_url.required' => '请输入来源地址！',
            'art_tags.required' => '请输入文章标签！',
            'art_intro.required' => '请填写文章简介！',
            'art_content.required' => '请填写文章内容！',
            'art_status.required' => '请选择文章状态！',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }

        $request->art_ispay     = $request->art_ispay?$request->art_ispay:0;
        $request->art_istop     = $request->art_istop?$request->art_istop:0;
        $request->art_isbest    = $request->art_isbest?$request->art_isbest:0;

        Article::where('art_id', $request->edit_id)->update([
            'art_title'     => $request->art_title,
            'copy_from'     => $request->copy_from,
            'org_url'       => $request->org_url,
            'copy_url'      => $request->copy_url,
            'art_tags'      => $request->art_tags,
            'art_intro'     => $request->art_intro,
            'art_content'   => $request->art_content,
            'art_status'    => $request->art_status,
            'art_ispay'     => $request->art_ispay,
            'art_istop'     => $request->art_istop,
            'art_isbest'    => $request->art_isbest,
        ]);

        $BaiduPushZZ    = new BaiduPushZZ();
        $BaiduPushZZ->push(["http://www.webshowu.com/artinfo-". $request->edit_id .".html"]);
        return redirect::back()->withInput($request->all())->with('success', $request->web_url.'已经修改成功！');
    }

    /**
     * 管理后台 用户设置
     *
     * @return \Illuminate\Http\Response
     */
    public function setting_edit(Request $request)
    {
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '用户修改资料 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '用户修改资料 - 秀站分类目录分享网站价值';
        $data['site_description'] = '用户修改资料 - 秀站分类目录分享网站价值';
        $data['site_nav'] = '用户修改资料';

        $data['myself'] = $request->user('admin');
        return view('admin.setting_edit',$data);
    }

    /**
     * 管理后台 用户修改密码
     *
     * @return \Illuminate\Http\Response
     */
    public function password_edit(Request $request)
    {
        $data['pagename'] = '后台管理——首页';
        $data['site_title'] = '用户密码修改 - 秀站分类目录分享网站价值';
        $data['site_keywords'] = '用户密码修改 - 秀站分类目录分享网站价值';
        $data['site_description'] = '用户密码修改 - 秀站分类目录分享网站价值';
        $data['site_nav'] = '用户密码修改';

        $data['myself'] = $request->user('admin');
        return view('admin.password_edit',$data);
    }

    /**
     * 管理后台 用户修改密码
     *
     * @return \Illuminate\Http\Response
     */
    public function password_update(Request $request)
    {
        $rules = [
            //'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ];
        $messages = [
            //'old_password.required' => '输入您现在使用的密码！',
            //'old_password.min' => '旧密码 至少为 6 个字符',
            'new_password.required' => '输入您新的密码！',
            'new_password.min' => '新密码 至少为 6 个字符',
            'confirm_password.required' => '重新再次输入新的密码！',
            'confirm_password.min' => '确认密码 至少为 6 个字符',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if($request->new_password != $request->confirm_password){
            return Redirect::back()->withErrors('两次密码输入不一致，请重新输入！');
        }

        $admin = Admin::findOrFail($request->user('admin')->id);
        $admin->fill([
            'password' => Hash::make( $request->new_password )
        ])->save();

        return redirect::to('/admin/password')->with('success','密码修改成功！');
    }

    /**
     * 分类数据
     *
     * @return \Illuminate\Http\Response
     */
    function get_category_option($cate_mod = 'webdir', $root_id = 0, $cate_id = 0, $level_id = 0)
    {
        if (!in_array($cate_mod, array('webdir', 'article'))) $cate_mod = 'webdir';

        $results = Categorie::where('root_id', $root_id )->where('cate_mod', $cate_mod )->orderBy('cate_order','asc')->orderBy('cate_id','asc')->get();
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
