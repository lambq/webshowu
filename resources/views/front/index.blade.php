@extends('layouts.front')

@section('content')
  
  <div class="am-g am-g-fixed index">
    @if($success !='xiumei')
    <div class="am-u-sm-12">
      <h1><div class="am-alert am-alert-danger" data-am-alert>{{ $success }}</div></h1>
    </div>
    @endif

    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6 box">
      <h1 class="green am-text-center">热点头条</h1>
      <ul class="am-list">
        @foreach ($articles as $str)
          <li>
            <a class="am-text-center am-text-truncate" target="_blank" href="{{ url('/artinfo-'.$str->art_id.'.html') }}" title="{{ $str->art_title }}">
              {{ $str->art_title }}
            </a>
          </li>
        @endforeach
      </ul>
    </div>

    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6 box">
      <h1 class="pink am-text-center">活跃网站</h1>
      <ul class="am-list">
        @foreach ($hotsites as $str)
          <li>
            <a class="am-text-center am-text-truncate" target="_blank" href="{{ url('/siteinfo-'.$str->web_id.'.html') }}" title="{{ $str->web_name }}">
              {{ $str->web_name }}
            </a>
          </li>
        @endforeach
      </ul>
    </div>

    <div class="am-u-sm-12 box">
      <h1 class="green am-text-center">秀导航</h1>
      @foreach ($cates as $str)
        <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default" >
          <h2 class="am-titlebar-title ">
              {{ $str['cate_name'] }}
          </h2>
          <nav class="am-titlebar-nav">
              <a title="{{ $str['cate_name'] }}更多" href="{{ url('/webdir/'.$str['cate_id']) }}" target="_blank" class="">更多 &raquo;</a>
          </nav>
        </div>
        <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-6 am-gallery-bordered" data-am-gallery="{  }" >
          @foreach ($str['site_array'] as $str_array)
              <li>
                <div class="am-gallery-item">
                    <a title="{{ $str_array->web_name }}" target="_blank" href="{{ url('/siteinfo-'.$str_array->web_id.'.html') }}">
                      <img class="lazy" data-original="http://api.webthumbnail.org/?width=480&height=330&screen=1280&url={{ $str_array->web_url }}" src="{{ url('images/lazy_loading.jpg') }}"  alt="{{ $str_array->web_name }}"/>
                        <h3 class="am-gallery-title">{{ $str_array->web_name }}</h3>
                        <div class="am-gallery-desc">{{ $str_array->web_views}}</div>
                    </a>
                </div>
              </li>
          @endforeach
        </ul>
      @endforeach
    </div>

    <div class="am-u-sm-12 box">
      <h1 class="pink am-text-center">友情链接</h1>
      <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-6">
        @foreach ($links as $str)
        <li><a href="{{ $str->link_url }}" target="_blank" title="{{ $str->link_name }}">{{ $str->link_name }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
@endsection
