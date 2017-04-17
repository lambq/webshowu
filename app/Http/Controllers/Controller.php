<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * 递归分类目录
     */
    function cates()
    {
        $array = array();
        $cate = Categorie::where('cate_mod','webdir')->where('root_id','0')->orderBy('cate_id','asc')->select('cate_name','cate_img','cate_dir','cate_id','cate_arrchildid')->get();
        foreach($cate as $str){
            $cate_data = $str;
            $collects = explode(",",$str->cate_arrchildid);
            $cate_data['site_array'] = Categorie::orderBy('cate_id','asc')->whereIn('cate_id',$collects)->get();
            $array[] = $cate_data;
        }
        return $array;
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
