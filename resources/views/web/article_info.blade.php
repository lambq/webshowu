@extends('layouts.web')

@section('content')
<div class="am-g am-g-fixed article">
  <div class="am-u-sm-12 am-u-md-8 am-u-lg-8">
    <h1>{{$articles->art_title}}</h1>

    <div class="tag">
      <h3 class="am-u-sm-3 am-u-md-2 am-u-lg-2 ">标签：<em class="am-icon-tags"></em></h3>  
      <p class="am-u-sm-9 am-u-md-10 am-u-lg-10">
        @foreach ($arttags as $str)
          <a target="_blank" title="{{$str}}" href="http://zhannei.baidu.com/cse/search?q={{$str}}&s=5924146839921945097">{{$str}}</a>
        @endforeach
      </p>
    </div>
    
    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />

    <p class="am-article-lead">{{$articles->art_intro}}</p>

    <article data-am-widget="paragraph" class="am-paragraph am-paragraph-default" data-am-paragraph="{ tableScrollable: true, pureview: true }">
      {!! $parsedown !!}
    </article>

    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />

    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
      <!--上一篇，下一篇-->
      <p>上一篇：@if ($prev)<a href="{{ url('/artinfo-'.$prev->art_id.'.html') }}">{{$prev->art_title}}</a> @else 没有了 @endif</p>
      <p>下一篇：@if ($next)<a href="{{ url('/artinfo-'.$next->art_id.'.html') }}">{{$next->art_title}}</a> @else 没有了 @endif</p>
    </div>

  </div>
  @include('web.right_list')
</div>
@endsection
