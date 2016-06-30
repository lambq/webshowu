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
    @include('UEditor::head')
</head>
<body>
<div class="am-g">
  <div class="am-u-sm-2">
    <ul class="am-nav">
      <li ><a href="{{ url('/') }}">返回首页</a></li>
      <li @if($site_nav == 'index') class="am-active" @endif ><a href="{{ url('/home') }}">个人信息</a></li>
      <li @if($site_nav == '1') class="am-active" @endif ><a href="#">关联帐户</a></li>
      <li @if($site_nav == 'Website') class="am-active" @endif ><a href="{{ url('/get_site') }}">我的站点</a></li>
      <li @if($site_nav == 'Article') class="am-active" @endif ><a href="{{ url('/get_art') }}">我的投稿</a></li>
      <li @if($site_nav == '1') class="am-active" @endif ><a href="{{ url('/logout') }}">安全退出</a></li>
    </ul>
  </div>
  <div class="am-u-sm-10">
    <!-- content -->
    @yield('content')
  </div>
</div>








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
