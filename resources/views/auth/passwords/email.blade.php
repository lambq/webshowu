@extends('layouts.log_reg')

<!-- Main Content -->
@section('content')
  <div class="header">
    <div class="am-g">
      <h1>忘记密码</h1>
    </div>
    <hr />
  </div>
  <div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
      @if (session('status'))
      <div class="am-alert am-alert-success" data-am-alert>
        <button type="button" class="am-close">&times;</button>
        <p>{{ session('status') }}</p>
      </div>
      @endif

      <br>

      <form class="am-form" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}

        <label for="email">邮箱:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        @if ($errors->has('email'))
          <span class="am-icon-warning">{{ $errors->first('email') }}</span>
        @endif
        <br>
        
        <div class="am-cf">
          <button type="submit" class="am-btn am-btn-primary">发送密码重置链接</button>
        </div>
      </form>

      <hr>
      <p>&copy; 2014 Allwebshowu, Inc. Licensed under MIT license.</p>
    </div>
  </div>

@endsection
