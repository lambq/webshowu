@extends('layouts.front')

@section('content')
<div class="am-g am-g-fixed article">
  <div class="am-u-sm-12 am-u-md-8 am-u-lg-8"> 
    <h1>{{$site_title}}</h1>
    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-1 am-avg-md-1 am-avg-lg-1 am-gallery-bordered" data-am-gallery="{  }" >
      @foreach ($articles as $str)
      <li>
        <div class="am-gallery-item team-box art_box">
            <div class="am-u-sm-3 am-u-md-3 am-u-lg-3 team-tx">
              <a href="{{ url('/artinfo-'.$str->art_id.'.html') }}">
                <img class="index_img" src="{{ get_pic($str->art_content,0)}}">
              </a>
            </div>
            <div class="am-u-sm-9 am-u-md-9 am-u-lg-9 team-js">
              <a href="{{ url('/artinfo-'.$str->art_id.'.html') }}" title="{{ $str->art_title }}">
                <h5 class="am-text-truncate">{{ $str->art_title }}</h5>
              </a>
              <p>
                @foreach (get_tags($str->art_tags) as $str_tags)
                <a target="_blank" title="{{$str_tags}}" href="http://zhannei.baidu.com/cse/search?q={{$str_tags}}&s=5924146839921945097">{{ str_limit($str_tags,10,'') }}</a>
                @endforeach
              </p>  
              <span class="am-fr">
                <em class="am-icon-clock-o">{{$str->updated_at->toDateString()}}</em>
              </span>
            </div>
        </div>
      </li>
      @endforeach
    </ul>
    {!! $articles->links() !!}
  </div>
  @include('front.right_list')
</div>
@endsection
