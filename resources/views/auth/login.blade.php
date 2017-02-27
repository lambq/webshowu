@extends('layouts.web_login')

@section('content')
    <div class="am-g am-g-fixed">
        <div class="color-padding-top">
            <div class="am-u-md-12 am-u-end">
                <div class="color-form-group">
                    <div class="color-form-group-title">
                      登录
                    </div>
                    <form role="form" method="POST" action="{{ url('/login') }}" class="am-form">
                        {{ csrf_field() }}
                        <div class="color-form-group color-form-line">
                            <span class="color-form-control-ico">
                                <i class="am-icon-user"></i>
                            </span>
                            <input class="color-form-control color-form-control-ico-input-left" placeholder="邮箱/用户名/已验证手机" id="email" type="email" name="email" value="{{ old('email') }}">
                            <label class="color-form-control-label">用户名</label>
                            @if ($errors->has('email'))
                                <span class="color-form-control-help am-icon-warning">{{ $errors->first('email') }}</span>
                            @else
                                <span class="color-form-control-help">邮箱/用户名/已验证手机</span>
                            @endif
                        </div>

                        <div class="color-form-group color-form-line">
                            <span class="color-form-control-ico">
                                <i class="am-icon-key"></i>
                            </span>
                            <input class="color-form-control color-form-control-ico-input-left" placeholder="密码" id="email" type="password" name="password">
                            <label class="color-form-control-label">密码</label>
                            @if ($errors->has('password'))
                                <span class="color-form-control-help am-icon-warning">{{ $errors->first('password') }}</span>
                            @else
                                <span class="color-form-control-help">请输入密码</span>
                            @endif
                        </div>

                        <div class="color-form-group color-form-line">
                            <button type="submit" class="am-btn am-btn-secondary am-radius">登录</button>
                        </div>
                    </form>

                    <a href="{{ url('/oauth/github') }}" class="am-btn am-btn-secondary am-btn-sm"><i class="am-icon-github am-icon-sm"></i> Github</a>
                    {{--<a href="{{ url('/oauth/qq') }}" class="am-btn am-btn-success am-btn-sm"><i class="am-icon-qq am-icon-sm"></i> QQ</a>--}}

                    <br/>

                    <a href="{{ url('/password/reset') }}" class="am-btn am-btn-default am-btn-sm am-fr">忘记密码 ^_^? </a>

                    <br/>

                    <p>© 2014 Allwebshowu, Inc. Licensed under MIT license.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
