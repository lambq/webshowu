<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="{{ $site_keywords }}" />
    <meta name="Description" content="{{ $site_description }}" />
    <meta property="qc:admins" content="451134620767523077563757" />
    <title>{{ $site_title }}</title>
    <link rel="icon" type="image/png" href="{{ url('favicon.png') }}">
    <link rel="stylesheet" href="{{ url('css/amazeui.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body>
<!-- header -->
<header class="am-topbar">
  <div class="am-container">
    <h1 class="am-topbar-brand">
      <a href="{{ url('/') }}">秀站分类目录</a>
    </h1>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}">
      <span class="am-sr-only">导航切换</span>
      <span class="am-icon-bars"></span>
    </button>

    <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
      <ul class="am-nav am-nav-pills am-topbar-nav">
        <li @if($site_nav == 'index') class="am-active" @endif><a href="{{ url('/') }}">首页</a></li>
        <li @if($site_nav == 'qrcode') class="am-active" @endif><a title="秀二维码" href="{{ url('/qrcode') }}">秀二维码</a></li>
        <li @if($site_nav == 'webdir') class="am-active" @endif><a title="秀目录" href="{{ url('/webdir') }}">秀目录</a></li>
        <li @if($site_nav == 'article') class="am-active" @endif><a title="秀资讯" href="{{ url('/article') }}">秀资讯</a></li>
        <!-- <li><a target="_blank" title="秀文档" href="http://doc.webshowu.com">秀文档</a></li> -->
      </ul>

      <form class="am-topbar-form am-topbar-left am-form-inline" target="_blank" role="search" action="http://zhannei.baidu.com/cse/search" method="GET">
        <div class="am-form-group">
          <input type="text" name="q" class="am-form-field am-input-sm" placeholder="搜索">
          <input type="hidden" name="s" value="5924146839921945097"/>
        </div>
      </form>

      <div class="am-topbar-right">
      <div class="am-topbar-right">
        @if (Auth::guest())
        <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm" title="秀站登录" href="{{ url('/login') }}" target="_blank">登录</a>
        @else
        <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm" title="安全退出" href="{{ url('/logout') }}" target="_blank">安全退出</a>
        <a class="am-btn am-btn-primary am-topbar-btn am-btn-sm" title="个人中心" href="{{ url('/home') }}" target="_blank">个人中心</a>
        @endif
      </div>
    </div>
  </div>
</header>

<!-- content -->
@yield('content')

<!-- gotop -->
<div data-am-widget="gotop" class="am-gotop am-gotop-fixed" >
  <a href="#top" title="">
        <i class="am-gotop-icon am-icon-hand-o-up"></i>
  </a>
</div>

<!-- footer -->
<footer class="newfooter">
  <hr/>
  <p class="am-text-center">
    @foreach ($pages as $str)
    <a target="_blank" title="{{ $str->page_name }}" href="{{ url('/diypage-'.$str->page_id.'.html') }}">{{ $str->page_name }}</a> | 
    @endforeach
    <!-- <a target="_blank" title="站点地图" href="{{ url('/sitemap') }}">站点地图</a> -->
  </p>
  <p class="am-text-center">
    <a href="http://www.webshowu.com/">秀站分类目录</a>&nbsp;&nbsp;
    北京儒尚科技有限公司【<a rel="nofollow" href="http://www.miibeian.gov.cn">京ICP备14053701号-4</a>】&nbsp;&nbsp;
    QQ群：55725231&nbsp;&nbsp;
    <script src="http://s95.cnzz.com/z_stat.php?id=1257630163&web_id=1257630163" language="JavaScript"></script>
  </p>
	<p class="am-text-center">
		源代码下载
	</p>
	<p class="am-text-center">
		<a target="_blank" href="https://github.com/lambq/webshowu" title="github项目源代码" class="am-icon-btn am-secondary am-icon-git-square"></a>
	</p>
</footer>



<!-- JavaScripts -->
<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="{{ url('js/amazeui.ie8polyfill.min.js') }}"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ url('js/jquery.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ url('js/amazeui.min.js') }}"></script>
<script src="{{ url('js/amazeui.lazyload.min.js') }}"></script>
<script>
  $(function() {
    $("img.lazy").lazyload({ effect : 'fadeIn'});
  });
</script>

<script>
(function(){
var bp = document.createElement('script');
bp.src = '//push.zhanzhang.baidu.com/push.js';
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(bp, s);
})();
</script>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?73d6f22b97da2e1d37ee429edbecaf61";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<script>
(function(){
   var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?3bb1e90adc41890b9e10aaf78d8e5811":"https://jspassport.ssl.qhimg.com/11.0.1.js?3bb1e90adc41890b9e10aaf78d8e5811";
   document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
</script>

@if(isMobile())
@else
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"5","bdPos":"right","bdTop":"100"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
@endif
</body>
</html>
