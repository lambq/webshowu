@extends('layouts.log_reg')

@section('content')
    <div class="header">
        <div class="am-g">
            <h1>秀登陆</h1>
        </div>
        <hr />
    </div>
  <div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
      <h3>登录</h3>
      <hr>
      <div class="am-btn-group">
        <a href="{{ url('/oauth/github') }}" class="am-btn am-btn-secondary am-btn-sm"><i class="am-icon-github am-icon-sm"></i> Github</a>
        {{--<a href="{{ url('/oauth/qq') }}" class="am-btn am-btn-success am-btn-sm"><i class="am-icon-qq am-icon-sm"></i> QQ</a>--}}
      </div>
      <br>
      <form role="form" method="POST" action="{{ url('/login') }}" class="am-form">
            {{ csrf_field() }}
            <label for="email">邮箱:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="am-icon-warning">{{ $errors->first('email') }}</span>
            @endif
            <br>
            <label for="password">密码:</label>
            <input type="password" name="password" id="password" value="">
            @if ($errors->has('password'))
                <span class="am-icon-warning">{{ $errors->first('password') }}</span>
            @endif
            <br>

            <div class="box" id="div_geetest_lib">
                <div id="captcha"></div>
            </div>

            <label for="remember-me">
                <input id="remember-me" type="checkbox" name="remember">记住密码
            </label>
            <br />
            <div class="am-cf">
                <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
                <a href="{{ url('/password/reset') }}" class="am-btn am-btn-default am-btn-sm am-fr">忘记密码 ^_^? </a>
            </div>
      </form>
      <hr>
	  <a href="{{ url('/register') }}" class="am-btn am-btn-primary am-btn-sm am-fl">注册</a>
	  <br>
      <p>© 2014 Allwebshowu, Inc. Licensed under MIT license.</p>
    </div>
  </div>
@endsection
