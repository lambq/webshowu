<?php
/** 获取指定URL内容 */
function get_url_content($url, $proxy = false) {
    $data = '';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER ,0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // 设置不将爬取代码写到浏览器，而是转化为字符串
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    if($proxy){
        //AppKey 信息，请替换
        $appKey = '160657822';
        //AppSecret 信息，请替换
        $secret = 'fd4f8fdd0ab2ccde7dab3cf93627d186';
        //示例请求参数
        $paramMap = array(
            'app_key'   => $appKey,
            'timestamp' => date('Y-m-d H:i:s'),
            'enable-simulate' => 'false',
        );
        //按照参数名排序
        ksort($paramMap);
        //连接待加密的字符串
        $codes = $secret;
        //请求的URL参数
        $auth = 'MYH-AUTH-MD5 ';
        foreach ($paramMap as $key => $val) {
            $codes .= $key . $val;
            $auth  .= $key . '=' . $val . '&';
        }
        $codes .= $secret;
        //签名计算
        $auth .= 'sign=' . strtoupper(md5($codes));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Proxy-Authorization: {$auth}"));
        curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
        curl_setopt($ch, CURLOPT_PROXY, '123.56.251.212'); //代理服务器地址
        curl_setopt($ch, CURLOPT_PROXYPORT, '8123'); //代理服务器端口
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式
    }
    $data = curl_exec($ch);
    if ($data  === FALSE) {
        return false;
    }
    curl_close($ch);
    if (!$data) {
        return false;
    } else {
        $encode = mb_detect_encoding($data, array('ascii', 'gb2312', 'utf-8', 'gbk'));
        if($encode != 'utf-8'){
            if($encode == 'EUC-CN' || $encode == 'CP936'){
                $data = @mb_convert_encoding($data, 'utf-8', 'gb2312');
            }else{
                $data = @mb_convert_encoding($data, 'utf-8', $encode);
            }   
        }
        return $data;
    }
}
/** 获取文章第一张图片 **/
function get_pic($content,$order='ALL'){
  $array = '';
  $pattern="/<img.*?data-original=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
  preg_match_all($pattern,$content,$match);
  if(isset($match[1])&&!empty($match[1])){
    if($order==='ALL'){
      $array= $match[1];
    }
    if(is_numeric($order)&&isset($match[1][$order])){
      $array= $match[1][$order];
    }
  }
  if(!$array){
    $array = "http://www.webshowu.com/images/loading.jpg";
  }
  return $array;
}
/** 获取关键词 **/
function get_tags($str,$num = 3){
  if($num){
    return array_slice(explode(',',$str),0,$num);
  }else{
    return explode(',',$str);
  }
}
/** 判断手机 **/
function isMobile(){  
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';  
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';        
    function CheckSubstrs($substrs,$text){  
        foreach($substrs as $substr)  
            if(false!==strpos($text,$substr)){  
                return true;  
            }  
            return false;  
    }
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');  
          
    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||  
              CheckSubstrs($mobile_token_list,$useragent);  
          
    if ($found_mobile){  
        return true;  
    }else{  
        return false;  
    }  
}
/** 百度站长链接推送 **/
function zhanzhang_push_baidu($url){
  $urls = [$url];
  $api = 'http://data.zz.baidu.com/urls?site=www.webshowu.com&token=6ujhg0alnRLbwZr7';
  $ch = curl_init();
  $options =  array(
      CURLOPT_URL => $api,
      CURLOPT_POST => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POSTFIELDS => implode("\n", $urls),
      CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
  );
  curl_setopt_array($ch, $options);
  $result = curl_exec($ch);
  return $result;
}
?>