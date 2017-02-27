@extends('layouts.web')

@section('content')
<div class="am-g am-g-fixed">
  <div class="am-u-sm-12 am-u-md-8 am-u-lg-8 am-u-end color-margin-bottom">
    <div class="color-card color-card-bordered color-card-color">
      <div class="color-card-head">
        <div class="color-card-head-title am-text-danger"> <i class="am-icon-github"></i> {{ $site_title }} </div>
      </div>
      <div class="color-card-extra">
        <div class="tool">
          <a href="javascript:;" class="collapse active"> </a>
          <a href="javascript:;" class="config"> </a>
          <a href="javascript:;" class="reload"> </a>
          <a href="javascript:;" class="remove"> </a>
        </div>
      </div>
      <div class="color-card-body">
        <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
          <div class="am-list-news-bd">
            <ul class="am-list">
              <!--缩略图在标题左边-->
              @foreach ($websites as $v)
              <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                <div class="am-u-sm-4 am-list-thumb">
                  <a href="{{ url('/siteinfo-'.$v->web_id.'.html') }}" title="{{ $v->web_name }}" target="_blank">
                    <img class="lazy" data-original="http://api.webthumbnail.org/?width=480&height=330&screen=1280&url={{ $v->web_url }}" src="{{ url('images/lazy_loading.jpg') }}" src=""  alt="{{ $v->web_name }}"/>
                  </a>
                </div>
                <div class=" am-u-sm-8 am-list-main">
                  <h3 class="am-list-item-hd">
                    <a href="{{ url('/siteinfo-'.$v->web_id.'.html') }}" title="{{ $v->web_name }}" target="_blank">
                      {{ $v->web_name }}
                    </a>
                  </h3>
                  <div class="am-list-item-text">{{ $v->web_intro }}</div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        {!! $websites->links() !!}
      </div>
    </div>
  </div>
  @include('web.right_list')
</div>  
@endsection
