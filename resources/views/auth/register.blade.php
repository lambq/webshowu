@extends('layouts.log_reg')

@section('content')
  <div class="header">
    <div class="am-g">
      <h1>秀注册</h1>
    </div>
    <hr />
  </div>
  <div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
      <form class="am-form" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}

        <label for="name">姓名:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @if ($errors->has('name'))
          <span class="am-icon-warning">{{ $errors->first('name') }}</span>
        @endif

        <br>

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

        <label for="password-confirm">确认密码:</label>
        <input type="password" name="password_confirmation" id="password-confirm" value="">
        @if ($errors->has('password_confirmation'))
          <span class="am-icon-warning">{{ $errors->first('password_confirmation') }}</span>
        @endif

        <br>
        
        <div class="am-cf">
          <button type="submit" class="am-btn am-btn-primary">注册</button>
        </div>
      </form>
    </div>
  </div>

@endsection
