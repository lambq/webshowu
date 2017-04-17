<?php

namespace App\Http\Controllers\Api;

use Lambq\Sdk\Facades\Spider;
use Lambq\Sdk\Facades\BaiduPushZZ;
use App\Jobs\SeoSite;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request int  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$domain)
    {
        //
        $url    = 'http://'.$domain;
        $parts = parse_url($url);
        $result = $this->file_get_contents_curl($url);
        if($result){
            $spider  = new Spider($result[1]);
            $tags  = $spider->info();
            $title          = array_key_exists('title', $tags) ? $tags['title'] : $parts['host'];
            $description    = array_key_exists('description', $tags) ? $tags['description'] : $parts['host'];
            $keywords       = array_key_exists('keywords', $tags) ? $tags['keywords'] : $parts['host'];
        }else{
            return response()->json([
                'status'    => 0,
                'data'      => '您的'.$parts['host'].'站点内容信息无法获取！请您检查自己的站点……',
            ],200);
        }
        $websites = DB::table('websites')->where('web_url', $domain)->first();
        if($websites){
            if($websites->web_content){
                $result = json_decode($websites->web_content,true);
                $result['web_name']     = $websites->web_name;
                $result['web_tags']     = $websites->web_tags;
                $result['web_intro']    = $websites->web_intro;
                $result['web_serv']     = $websites->web_serv;
                $result['updated_at']   = $websites->updated_at;
            }else{
                DB::table('websites')->where('web_url', $parts['host'])->update([
                    'web_serv'      => $result[0],
                    'updated_at'    => date("Y-m-d H:i:s",time()),
                ]);
                dispatch(new SeoSite([
                    'user'          => $request->user(),
                    'site'          => $parts['host'],
                ]));
                $result = [
                    'url'               => $domain,    //域名
                    'web_name'          => $websites->web_name,
                    'web_tags'          => $websites->web_tags,
                    'web_intro'         => $websites->web_intro,
                    'web_serv'          => [],
                    'updated_at'        => $websites->updated_at,
                    'alexa_check'       => [
                        'reach_rank'    => 0,
                        'traffic_rank'  => 0,
                    ],    //Alexa 查询API
                    'domainrank'        => [
                        'google'    => 0,
                        'baidu'     => 0,
                        'so'        => 0,
                        'sogou'     => 0,
                    ], //网站权重查询API
                    'domainbacklink'    => [
                        'google'    => 0,
                        'baidu'     => 0,
                        'bing'      => 0,
                        'yahoo'     => 0,
                        'so'        => 0,
                        'sogou'     => 0,
                    ],    //网站反链查询AP
                    'domainindexd'      => [
                        'google'    => 0,
                        'baidu'     => 0,
                        'bing'      => 0,
                        'yahoo'     => 0,
                        'so'        => 0,
                        'sogou'     => 0,
                    ],   //网站收录查询API
                    'domain_ip_check'   => [
                        'isp'       => 0,
                        'ip'        => 0,
                        'city'      => 0,
                        'region'    => 0,
                        'country'   => 0,
                        'time_zone' => 0,
                        'longitude' => 0,
                        'latitude'  => 0,
                    ],  //Domain IP 查询API
                ];
            }
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
            $info = DB::table('websites')->where('web_id', $id)->first();
            dispatch(new SeoSite([
                'user'          => $request->user(),
                'site'          => $parts['host'],
            ]));
            $result = [
                'url'               => $domain,    //域名
                'web_name'          => $info->web_name,
                'web_tags'          => $info->web_tags,
                'web_intro'         => $info->web_intro,
                'web_serv'          => $info->web_serv,
                'updated_at'        => $info->updated_at,
                'alexa_check'       => [
                    'reach_rank'    => 0,
                    'traffic_rank'  => 0,
                ],    //Alexa 查询API
                'domainrank'        => [
                    'google'    => 0,
                    'baidu'     => 0,
                    'so'        => 0,
                    'sogou'     => 0,
                ], //网站权重查询API
                'domainbacklink'    => [
                    'google'    => 0,
                    'baidu'     => 0,
                    'bing'      => 0,
                    'yahoo'     => 0,
                    'so'        => 0,
                    'sogou'     => 0,
                ],    //网站反链查询AP
                'domainindexd'      => [
                    'google'    => 0,
                    'baidu'     => 0,
                    'bing'      => 0,
                    'yahoo'     => 0,
                    'so'        => 0,
                    'sogou'     => 0,
                ],   //网站收录查询API
                'domain_ip_check'   => [
                    'isp'       => 0,
                    'ip'        => 0,
                    'city'      => 0,
                    'region'    => 0,
                    'country'   => 0,
                    'time_zone' => 0,
                    'longitude' => 0,
                    'latitude'  => 0,
                ],  //Domain IP 查询API
            ];
        }
        return response()->json([
            'status'    => '1',
            'data'      => $result
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /** 获取headers信息 **/
    function get_header($strs){
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
