<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Article, App\Website, App\Link, App\Lable, App\Category, App\Page;

class IndexController extends Controller
{
    //首页
    function Index (Request $request){
        $data['site_title'] = '秀站分类目录|中文分类目录|网站分类目录|免费网站目录|dmoz目录-北京儒尚科技有限公司';
        $data['site_keywords'] = 'DMOZ目录,DMOZ分类目录,网站收录,网站目录,网站登录,中文网站目录,秀站分类目录,分类目录,秀站分类目录分享网站价值,秀站,秀站目录,免费网站目录';
        $data['site_description'] = '秀站分类目录免费收录各类优秀中文网站，提供网站分类目录检索，关键字搜索，提供网站即可免费快速提升网站流量，分享网站价值也是中国dmoz的标志';
        $data['articles'] = Article::where(['art_status'=>'3'])->orderBy('updated_at','desc')->take('5')->get();
        $data['websites'] = Website::where(['web_status'=>'3'])->orderBy('web_isbest','desc')->orderBy('updated_at','desc')->take('5')->get();
        $data['hotsites'] = Website::where(['web_status'=>'3'])->orderBy('updated_at','desc')->take('5')->get();
        $data['links'] = Link::where(['link_hide'=>'1'])->orderBy('link_order','asc')->get();
        $data['lables'] = Lable::where(['cate_mod'=>'webdir'])->orderBy('lab_views','desc')->take('30')->get();
        $data['cates'] = $this->Cates();
        $data['pages'] = Page::get();
        $data['success'] = 'xiumei';
        $data['site_nav'] = 'index';
        $success = false;//$this->xiumei_proxy($request);
        if($success){
          $data['success'] = $success;
        }
        return view('front/index',$data);
    }

    //测试功能
    function ceshi (Request $request){
        $regqrcode = array(
          'reg_list' => '.includeLi',
          'list'=>  array(
            array('name'=>'title','is_status'=> 'true','reg_list'=>'.name','ishost'=>true,'host'=>'http://www.haoduoqun.com','type'=>'text'),
            array('name'=>'href','is_status'=> 'true','reg_list'=>'.name','ishost'=>false,'host'=>'http://www.haoduoqun.com','type'=>'attr','type_name'=>'href'),
            array('name'=>'pic','is_status'=> 'true','reg_list'=>'img','ishost'=>true,'host'=>'http://www.haoduoqun.com','type'=>'attr','type_name'=>'src'),
          )
        );

        $reg5118 = array(
          'reg_list' => '.news-list .title',
          'list' => array(
            array('name'=>'title','is_status'=>true,'reg_list'=>'','type'=>'text'),
            array('name'=>'href','is_status'=>true,'reg_list'=>'','ishost'=>true,'host'=>'http://www.5118.com','type'=>'attr','type_name'=>'href')
          )
        );
        //UPDATE `reg_list` SET `reg_list` = '{"reg_list":".news-list .title","list":[{"name":"title","is_status":true,"reg_list":"","type":"text"},{"name":"href","is_status":true,"reg_list":"","ishost":true,"host":"http:\/\/www.5118.com","type":"attr","type_name":"href"}]}' WHERE `reg_type` ='5118';
        
        //echo json_encode($regqrcode);

        $regweixin = array(
          'reg_list' => '.results .wx-rb',
          'list' => array(
            array('name'=>'title','is_status'=>true,'reg_list'=>'h4 a','type'=>'text'),
            array('name'=>'href','is_status'=>true,'reg_list'=>'h4 a','ishost'=>false,'type'=>'attr','type_name'=>'href')
          )
        );
        $html = get_url_content('http://www.haoduoqun.com/news-90-1.html');
        //UPDATE `reg_list` SET `reg_list` = '{"reg_list":".results .wx-rb","list":[{"name":"title","is_status":true,"reg_list":"h4 a","type":"text"},{"name":"href","is_status":true,"reg_list":"h4 a","ishost":false,"type":"attr","type_name":"href"}]}' WHERE `reg_type` ='weixin';

        /*
        $reg = $regqrcode;
        $html = get_url_content('http://www.haoduoqun.com/news-90-1.html');
        if($html){
          $data = array();
          phpQuery::newDoclamb($html);
          $is_reg = pq($reg['reg_list'])->html();
          if($is_reg){
            foreach(pq($reg['reg_list']) as $res){
              $reg_array = array();
              foreach($reg['list'] as $str){
                if($str['is_status'] && $str['type'] == 'text'){
                  $reg_array[$str['name']] = trim(pq($res)->find($str['reg_list'])->text());
                }

                if($str['is_status'] && $str['type'] == 'attr'){
                  if($str['ishost']){
                    $reg_array[$str['name']] = $str['host'].pq($res)->find($str['reg_list'])->attr($str['type_name']);
                  }else{
                    $reg_array[$str['name']] = pq($res)->find($str['reg_list'])->attr($str['type_name']);
                  }
                }
              }
              $data[] = $reg_array;
            }
          }else{
            echo '获取不到列表';
          }
          phpQuery::$documents = array();
          print_r($data);
        }else{
          echo '无效果';
        }
        
        $html = get_url_content('http://www.haoduoqun.com/show-98230.html');
        phpQuery::newDoclamb($html);
        $array = array(
            'user_id' => '10000',
            'cate_id' => '',
            'qr_name' => $row['title'],
            'qr_pubname' => pq('.dl-horizontal dd:eq(2)')->text(),
            'qr_tags' => pq('.dl-horizontal dd:eq(1)')->text(),
            'qr_pic' => '',
            'qr_img' => 'http://www.haoduoqun.com'.pq('.lImg')->find('img')->attr('src'),
            'qr_intro' => pq('.dl-horizontal dd:eq(0)')->text(),
            'qr_views' => pq('.dl-horizontal dd:eq(4)')->text(),
            'qr_status' => '3',
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time()),
        );
        phpQuery::$documents = array();
        print_r($array);
        */
    }

    //标签
    function tags (Request $request){
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

    //帮助中心
    function Diypage (Request $request){
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

    //递归分类目录
    function Cates (){
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

    //基于反向链接
    function xiumei_proxy($request){
        if($request->server('HTTP_REFERER') && !str_contains($request->server('HTTP_REFERER'),'webshowu')){
            $app_url = $this->xiumei_parse_url($request->server('HTTP_REFERER'));
            $array = Website::where('web_url','like','%'.$app_url.'%')->first();
            if(!$array){
                if(get_url_content('http://'.$app_url)){
                    $this->xiumei_add($app_url);
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
    function xiumei_add($url){
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
    function xiumei_parse_url($url,$type=0){
        if($type == 0){
            $array = parse_url($url);
            return $array['host'];
        }
        return false;
    }
}
