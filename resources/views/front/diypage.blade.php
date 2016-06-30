@extends('layouts.front')

@section('content')

<div class="am-g am-g-fixed diypage">
  <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <nav data-am-widget="menu" class="am-menu  am-menu-default"> 
      <a href="javascript: void(0)" class="am-menu-toggle">
        <i class="am-menu-toggle-icon am-icon-bars"></i>
      </a>
      <ul class="am-menu-nav am-avg-sm-3">
        @foreach ($pages as $str)
          <li class="">
            <a title="{{ $str->page_name }}" href="{{ url('/diypage-'.$str->page_id.'.html') }}">{{ $str->page_name }}</a>
          </li>
        @endforeach
      </ul>
    </nav>
  </div>

  <!-- <div class="am-u-sm-12 am-u-md-4 am-u-lg-4 team-box">
    <ul class="am-nav">
      @foreach ($pages as $str)
        <li class="list-group-item">
          <a title="{{ $str->page_name }}" href="{{ url('/diypage-'.$str->page_id.'.html') }}">{{ $str->page_name }}</a>
        </li>
      @endforeach
    </ul>
  </div> -->
  <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
    <article class="am-article">
      <div class="am-article-hd">
        <h1 class="am-article-title">{{ $page_first->page_name }}</h1>
      </div>

      <div class="am-article-bd">
        {!! $page_first->page_content !!}
      </div>
    </article>
  </div>
</div>
@endsection
