@extends('layouts.admin_login')

@section('content')
    <div class="header">
        <div class="am-g">
            <h1>E转诊新后台——管理平台</h1>
        </div>
        <hr/>
    </div>
    <div class="am-g">
        <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
            <h3>登陆</h3>
            <hr/>
            <form role="form" method="post" action="{{ url('login') }}" class="am-form">
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
                <label for="remember-me">
                    <input id="remember-me" type="checkbox" name="remember">
                    记住密码
                </label>
                <br />
                <div class="am-cf">
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm am-fl">
                        登 录
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
