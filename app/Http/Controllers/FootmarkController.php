<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User, App\Article, App\Website, App\Page;

class FootmarkController extends Controller
{
    /**
	 * 秀足迹的内容
	 */
    function info(Request $request)
	{
        if(!$request->id){
            return redirect('/');
        }

        $users = User::where('id', $request->id )->first();
        if($users){
            $data['site_title'] = $users->name.'的秀足迹 - 秀站分类目录分享网站价值';
            $data['site_keywords'] = $users->name.',秀足迹';
            $data['site_description'] = $users->name.'的秀足迹 - 秀站分类目录分享网站价值';
            $data['users'] = $users;
            $data['lists'] = $this->lists($request->id);
            $data['pages'] = Page::get();
            $data['site_nav'] = 'index';
            return view('front/footmark_info',$data);
        }else{
            return redirect('/');
        }
    }
	/**
	 * 秀足迹内容列的数据
	 */
    function lists($uid)
	{
        $lists = array();
        $Articles = Article::where(['user_id'=>$uid,'art_status'=>'3'])->orderBy('updated_at','desc')->get();
        foreach($Articles as $str){
            $data['id'] = $str->art_id;
            $data['title'] = $str->art_title;
            $data['intro'] = $str->art_intro;
            $data['updated_at'] = $str->updated_at;
            $data['type'] = 'art';
            $data['img'] = '';
            $lists[] = $data;
        }
        $Websites = Website::where(['user_id'=>$uid,'web_status'=>'3'])->orderBy('updated_at','desc')->get();
        foreach($Websites as $str){
            $data['web_url'] = $str->web_url;
            $data['id'] = $str->web_id;
            $data['title'] = $str->web_name;
            $data['intro'] = $str->web_intro;
            $data['updated_at'] = $str->updated_at;
            $data['type'] = 'img';
            $data['img'] = $str->web_pic;
            $lists[] = $data;
        }
        $lists = $this->arraySort($lists,'updated_at','desc');
        return $lists;
    }
	/**
	 * 二维数组排序
	 */
    function arraySort($arr, $keys, $type = 'asc')
	{
        $keysvalue = $new_array = array();
        foreach ($arr as $k => $v){
            $keysvalue[$k] = $v[$keys];
        }
        $type == 'asc' ? asort($keysvalue) : arsort($keysvalue);
        reset($keysvalue);
        foreach ($keysvalue as $k => $v) {
           $new_array[$k] = $arr[$k];
        }
        return $new_array;
    }
}
