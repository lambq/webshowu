<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="秀登陆" />
    <meta name="Description" content="秀登陆" />
    <meta property="qc:admins" content="451134620767523077563757" />
    <title>秀登陆</title>
    <link rel="icon" type="image/png" href="{{ url('favicon.png') }}">
    <link rel="stylesheet" href="{{ url('css/amazeui.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>

<!-- content -->
@yield('content')

<!-- gotop -->
<div data-am-widget="gotop" class="am-gotop am-gotop-fixed" >
  <a href="#top" title="">
        <i class="am-gotop-icon am-icon-hand-o-up"></i>
  </a>
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
<script src="https://static.geetest.com/static/tools/gt.js"></script>
<script>
    var handler = function (captchaObj) {
        // 将验证码加到id为captcha的元素里
        captchaObj.appendTo("#captcha");
    };
    $.ajax({
        // 获取id，challenge，success（是否启用failback）
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        url: "captcha?rand="+Math.round(Math.random()*100),
        type: "get",
        dataType: "json", // 使用jsonp格式
        success: function (data) {
            // 使用initGeetest接口
            // 参数1：配置参数，与创建Geetest实例时接受的参数一致
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: "float", // 产品形式
                offline: !data.success
            }, handler);
        }
    });
</script>
</body>
</html>
