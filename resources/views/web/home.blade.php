@extends('layouts.home')

@section('content')

  <div class="am-cf am-padding am-padding-bottom-0">
    <div class="am-fl am-cf">
      <strong class="am-text-primary am-text-lg">个人信息</strong> <!-- / <small>Personal information</small> -->
    </div>
  </div>
  <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

  <div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
      @if(count($errors) > 0)
        <div class="am-alert am-alert-danger" data-am-alert>
          <button type="button" class="am-close">&times;</button>
          <p>
            @foreach($errors->all() as $error)
            {{ $error }} &nbsp;&nbsp;
            @endforeach
          </p>
        </div>
      @endif
      @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
      @endif
      <form class="am-form" name="myfrom" id="myfrom" method="post" action="{{ url('/edit_site') }}">
        <fieldset>
          {{ csrf_field() }}
          <input type="hidden" value="{{ csrf_token() }}" name="_token" />
          <input type="hidden" value="{{ $myself->id }}" name="edit_id" />

          <div class="am-form-group">
            <label for="doc-nick_name">昵 称</label>
            <input type="text" name="name" id="doc-nick_name" placeholder="请输入昵 称" value="{{ $myself->name }}">
          </div>

          <p><button type="submit" class="am-btn am-btn-default">提交</button></p>
        </fieldset>
      </form>
    </div>
  </div>

@endsection
