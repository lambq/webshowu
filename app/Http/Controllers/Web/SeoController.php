<?php

namespace App\Http\Controllers\Web;

use Lambq\Sdk\Facades\Spider;
use Lambq\Sdk\Facades\BaiduPushZZ;
use App\Jobs\SeoSite;
use App\Models\Page;
use Redirect;
use Validator;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    //
    public function seo_index() {
        $data['site_title']         = '网站SEO综合查询,网站价值评估查询-儒尚秀站网';
        $data['site_keywords']      = '网站SEO综合查询,网站价值评估查询,儒尚秀站网';
        $data['site_description']   = '网站SEO综合查询,网站价值评估查询-儒尚秀站网';
        $data['site']               = DB::table('websites')->select('web_url')->orderBy('updated_at', 'desc')->take(100)->get();
        $data['pages']              = Page::get();
        $data['action']             = 'index';
        $data['site_nav']           = 'seo';
        return view('seo.seo_index',$data);
    }

    public function seo_update(Request $request) {
        $rules = [
            'site' => 'required',
        ];
        $messages = [
            'site.required' => '请输入网站域名！',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->all())->withErrors($validator);
        }
        $parts = parse_url('http://'.$request->site);
        if(!$this->CheckUrl('http://'.$parts['host'])){
            return Redirect::back()->withInput($request->all())->withErrors('您的'.$parts['host'].'格式不正确！请从新填写域名……');
        }
        $result = $this->file_get_contents_curl('http://'.$parts['host']);
        if($result){
            $spider  = new Spider($result[1]);
            $tags  = $spider->info();
            $title          = array_key_exists('title', $tags) ? $tags['title'] : $parts['host'];
            $description    = array_key_exists('description', $tags) ? $tags['description'] : $parts['host'];
            $keywords       = array_key_exists('keywords', $tags) ? $tags['keywords'] : $parts['host'];
        }else{
            return Redirect::back()->withInput($request->all())->withErrors('您的'.$parts['host'].'站点内容信息无法获取！请您检查自己的站点……');
        }
        $site   = DB::table('websites')->where('web_url', $parts['host'])->first();
        if($site){
            DB::table('websites')->where('web_url', $parts['host'])->update([
                'web_serv'      => $result[0],
                'updated_at'    => date("Y-m-d H:i:s",time()),
            ]);
            dispatch(new SeoSite([
                'site'          => $parts['host'],
            ]));
        }else{
            $id = DB::table('websites')->insertGetId([
                'user_id'       => 10000,
                'cate_id'       => 78,
                'web_url'       => $parts['host'],
                'web_name'      => $title,
                'web_tags'      => $keywords,
                'web_serv'      => $result[0],
                'web_intro'     => $description,
                'web_content'   => '',
                'web_ispay'     => 0,
                'web_istop'     => 0,
                'web_islink'    => 0,
                'web_ip'        => 0,
                'web_grank'     => 0,
                'web_brank'     => 0,
                'web_srank'     => 0,
                'web_arank'     => 0,
                'web_instat'    => 0,
                'web_outstat'   => 0,
                'web_views'     => 0,
                'web_status'    => 3,
                'created_at'    => date("Y-m-d H:i:s",time()),
                'updated_at'    => date("Y-m-d H:i:s",time()),
            ]);
            if($id){
                $BaiduPushZZ    = new BaiduPushZZ();
                $BaiduPushZZ->push(["http://www.webshowu.com/siteinfo-". $id .".html","http://www.webshowu.com/seo/$parts[host]"]);
            }
            dispatch(new SeoSite([
                'site'          => $parts['host'],
            ]));
        }
        return redirect::to('/seo/'.$request->site)->with('success', $request->site.'已经提交seo查询队列了，请稍等……');
    }

    public function seo_site(Request $request){
        $data['site_title']         = $request->site.' - SEO综合查询 - 儒尚秀站网';
        $data['site_keywords']      = $request->site.'的网站基本信息,'.$request->site.'的SEO综合查询,'.$request->site.'服务器信息,'.$request->site.'&alexa信息,'.$request->site.'网站权重,'.$request->site.'网站的收录/反链结果,'.$request->site.'域名的信息,儒尚秀站网';
        $data['site_description']   = $request->site.'的SEO综合查询信息,汇聚'.$request->site.'服务器信息、alexa网站排名、网站权重、收录（site）/反链(domain)、域名whois、ip等信息';
        $data['site']               = DB::table('websites')->where('web_url', $request->site)->first();
        $data['list']               = $data['site']->web_content ? json_decode( $data['site']->web_content ,true):[];
        $data['serv']               = $data['site']->web_serv ? $this->get_header($data['site']->web_serv) : [];
        $data['pages']              = Page::get();
        $data['action']             = 'update';
        $data['site_nav']           = 'seo';
        return view('seo.seo_index',$data);
    }

    function CheckUrl($C_url){
        $str="/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/";
        if (!preg_match($str,$C_url)){
            return false;
        }else{
            return true;
        }
    }

    /** 获取headers信息 **/
    public function get_header($strs){
        $array  = explode("\r\n", $strs);
        $array1 = [];
        foreach($array as $v) {
            if(strstr($v,':')){
                $str    = explode(': ',$v);
                $array1[$str['0']]  = $str['1'];
            }else{
                $array1['host']  = $v;
            }
        }
        return $array1;
    }

    function file_get_contents_curl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);//抓取网址
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Baiduspider/3.0; +http://www.baidu.com/search/spider.html)");//伪造百度蜘蛛头部
        $ip = '220.181.7.121';
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:' . $ip, 'CLIENT-IP:' . $ip));//伪造百度蜘蛛IP
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//
        curl_setopt($ch, CURLOPT_HEADER, true); //抓取服务器信息
        curl_setopt($ch, CURLOPT_NOBODY, false); //抓取网页信息
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); //支持301跳转
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30); //网页等待时间
        $data = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {
            $data = explode("\r\n\r\n", $data, 2);
        }
        curl_close($ch);
        return $data;
    }
}
