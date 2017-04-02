<?php

namespace App\Http\Controllers\Ceshi;

use Lambq\Sdk\Facades\Spider;
use Redirect;
use Validator;
use Storage;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CeshiController extends Controller
{
    //
    public function index(Request $request) {
        $websites = DB::table('websites')->select('web_url')->where('web_name', 'null')->take('5')->get();
//        print_r($websites);die();
        foreach($websites as $v){
            echo $v->web_url;
            $result = $this->file_get_contents_curl('http://'.$v->web_url);
            if($result){
                $spider  = new Spider($result[1]);
                $array  = $spider->info();
                DB::table('websites')->where('web_url', $v->web_url)->update([
                    'web_name'      => $array['title'],
                    'web_tags'      => $array['keywords'],
                    'web_intro'     => $array['description'],
                    'web_serv'      => $result[0],
                ]);
                echo "===ok<br/>";
            }else{
                echo "===no<br/>";
            }
        }
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
