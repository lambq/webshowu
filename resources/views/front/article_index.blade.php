@extends('layouts.front')

@section('content')
<div class="am-g am-g-fixed article">
  @foreach ($cates as $str)
    <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default" >
      <h2 class="am-titlebar-title ">
          {{ $str->cate_name }}
      </h2>
      <nav class="am-titlebar-nav">
          <a title="{{ $str->cate_name }}更多" href="{{ url('/article/'.$str->cate_dir ) }}" target="_blank" class="">更多 &raquo;</a>
      </nav>
    </div>
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-1 am-avg-md-2 am-avg-lg-2 am-gallery-bordered" data-am-gallery="{  }" >
      @foreach ($str['site_array'] as $str_array)
        <li>
          <div class="am-gallery-item team-box art_box">
            <div class="am-u-sm-4 am-u-md-4 am-u-lg-4 team-tx">                                  
              <a href="{{ url('/artinfo-'.$str_array->art_id.'.html') }}">
                <img class="index_img lazy" data-original="{{ get_pic($str_array->content,0)}}" src="{{ url('images/lazy_loading.jpg') }}">
              </a>
            </div>
            <div class="am-u-sm-8 am-u-md-8 am-u-lg-8 team-js">
              <a href="{{ url('/artinfo-'.$str_array->art_id.'.html') }}" title="{{ $str_array->title }}">
                <h5 class="am-text-truncate">{{ $str_array->title }}</h5>
              </a>
              <p>
                @foreach (get_tags($str_array->tags) as $str_tags)
                <a target="_blank" title="{{$str_tags}}" href="http://zhannei.baidu.com/cse/search?q={{$str_tags}}&s=5924146839921945097">{{ str_limit($str_tags,10,'') }}</a>
                @endforeach
              </p>  
              <span class="am-fr">
                <em class="am-icon-clock-o">{{ $str_array->updated_at->toDateString() }}</em>
              </span>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  @endforeach
</div>
@endsection