<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $site_title }}</title>
  <meta name="description" content="{{ $site_description }}">
  <meta name="keywords" content="{{ $site_keywords }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="{{ url('css/amazeui.min.css') }}"/>
  <link rel="stylesheet" href="{{ url('css/amazeui.tree.min.css') }}"/>
  <link rel="stylesheet" href="{{ url('css/admin.css') }}">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->
@include('admin.topbar')

<div class="am-cf admin-main">

	@include('admin.sidebar')
  <!-- content start -->
  <div class="admin-content">
    @yield('content')

    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">© 2014 Allwebshowu, Inc. Licensed under MIT license.</p>
    </footer>
  </div>
  <!-- content end -->
</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
  <hr>
  <p class="am-padding-left">© 2014 Allwebshowu, Inc. Licensed under MIT license.</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ url('js/jquery.min.js') }}"></script>
<!--<![endif]-->
<script src="{{ url('js/amazeui.min.js') }}"></script>
<script src="{{ url('js/amazeui.tree.min.js') }}"></script>
<script src="{{ url('js/app.js') }}"></script>
</body>
</html>
