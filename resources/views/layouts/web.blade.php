<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="{{ $site_keywords }}" />
    <meta name="Description" content="{{ $site_description }}" />
    <title>{{ $site_title }}</title>
    <link rel="icon" type="image/png" href="{{ url('favicon.png') }}">
    <link rel="stylesheet" href="{{ url('css/amazeui.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>
<body>
<!-- header -->
<header class="am-topbar am-topbar-fixed-top">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="{{ url('/') }}" title="儒尚秀站网">儒尚秀站网</a>
        </h1>
        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only" data-am-collapse="{target: '#collapse-head'}">
            <span class="am-sr-only">导航切换</span>
            <span class="am-icon-bars"></span>
        </button>
        <div class="am-collapse am-topbar-collapse" id="collapse-head">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <li @if($site_nav == 'index') class="am-active" @endif><a title="首页" href="{{ url('/') }}">首页</a></li>
                <li @if($site_nav == 'webdir') class="am-active" @endif><a title="秀目录" href="{{ url('/webdir') }}">秀目录</a></li>
                <li @if($site_nav == 'article') class="am-active" @endif><a title="秀资讯" href="{{ url('/article') }}">秀资讯</a></li>
                <li @if($site_nav == 'seo') class="am-active" @endif><a title="网站综合查询" href="{{ url('/seo') }}">网站综合查询</a></li>
            </ul>
            <form class="am-topbar-form am-topbar-left am-form-inline" target="_blank" role="search" action="http://zhannei.baidu.com/cse/search" method="GET">
                <div class="am-form-group">
                    <input type="text" name="q" class="am-form-field am-input-sm" placeholder="搜索">
                    <input type="hidden" name="s" value="5924146839921945097"/>
                </div>
            </form>
            @if (Auth::guest())
                <div class="am-topbar-right">
                    <button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm" onclick="event.preventDefault();
              document.getElementById('register-form').submit();">
                        <span class="am-icon-pencil"></span> 注册
                    </button>
                    <form id="register-form" action="{{ url('/register') }}" method="get" style="display: none;"></form>
                </div>
                <div class="am-topbar-right">
                    <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm" onclick="event.preventDefault();
              document.getElementById('login-form').submit();">
                        <span class="am-icon-user"></span> 登录
                    </button>
                    <form id="login-form" action="{{ url('/login') }}" method="get" style="display: none;"></form>
                </div>
            @else
                <div class="am-topbar-right">
                    <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm" onclick="event.preventDefault();
          document.getElementById('home-form').submit();">
                        <span class="am-icon-user"></span> 个人中心
                    </button>
                    <form id="home-form" action="{{ url('/home') }}" method="get" style="display: none;"></form>
                </div>
                <div class="am-topbar-right">
                    <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
                        <span class="am-icon-user"></span> 安全退出
                    </button>
                    <form id="logout-form" action="{{ url('/logout') }}" method="post" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            @endif
        </div>
    </div>
</header>
<br/>
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
    <a target="_blank" title="SEO综合查询接口文档" href="http://www.webshowu.com/wiki_seo.html">SEO综合查询接口文档</a>
  </p>
  <p class="am-text-center">
    版权归儒尚秀站网（webshowu） 所有 | 基于PHP技术构建 | 本站使用阿帕云服务器+七牛云
      <script>
          var _hmt = _hmt || [];
          (function() {
              var hm = document.createElement("script");
              hm.src = "https://hm.baidu.com/hm.js?52714deb03d391b28b6967ebcc3f643e";
              var s = document.getElementsByTagName("script")[0];
              s.parentNode.insertBefore(hm, s);
          })();
      </script>
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
<script src="{{ url('js/color.min.js') }}"></script>
<script src="{{ url('js/amazeui.lazyload.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('css/color.min.css') }}">
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
(function(){
   var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?3bb1e90adc41890b9e10aaf78d8e5811":"https://jspassport.ssl.qhimg.com/11.0.1.js?3bb1e90adc41890b9e10aaf78d8e5811";
   document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
</script>

<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"0","bdPos":"right","bdTop":"120.5"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"24"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
</body>
</html>
