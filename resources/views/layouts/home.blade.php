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
    <header class="am-topbar am-topbar-inverse am-topbar-fixed-top">
        <div class="am-container">
            <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only"
                    data-am-collapse="{target: '#doc-topbar-collapse-4'}">
                <span class="am-sr-only">导航切换</span>
                <span class="am-icon-bars"></span>
            </button>
            <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse-4">
                <ul class="am-nav am-nav-pills am-topbar-nav">
                    <li >
                        <a href="{{ url('/') }}">首页</a>
                    </li>
                    <li class="@if($site_nav == 'index') am-active @endif">
                        <a href="{{ url('/home') }}">个人信息</a>
                    </li>
                    <li class="@if($site_nav == '1') am-active @endif" >
                        <a href="#">关联帐户</a>
                    </li>
                    <li class="@if($site_nav == 'Website') am-active @endif" >
                        <a href="{{ url('/get_site') }}">我的站点</a>
                    </li>
                    <li class="@if($site_nav == 'Article') am-active @endif" >
                        <a href="{{ url('/get_art') }}">我的投稿</a>
                    </li>
                    <li class="@if($site_nav == '1') am-active @endif" >
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
                            安全退出
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- content -->
    @yield('content')

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
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?73d6f22b97da2e1d37ee429edbecaf61";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>
