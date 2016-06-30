@extends('layouts.front')

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
      {!! $articles->art_content !!}
    </article>

    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />

    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
      <!--上一篇，下一篇-->
      <p>上一篇：@if ($prev)<a href="{{ url('/artinfo-'.$prev->art_id.'.html') }}">{{$prev->art_title}}</a> @else 没有了 @endif</p>
      <p>下一篇：@if ($next)<a href="{{ url('/artinfo-'.$next->art_id.'.html') }}">{{$next->art_title}}</a> @else 没有了 @endif</p>
    </div>

    <!-- 多说评论框 start --> 
    <div class="ds-thread" data-thread-key="{{$articles->art_id}}" data-title="{{$articles->art_title}}" data-url='{{ url("/artinfo-$articles->art_id") }}.html'></div> <!-- 多说评论框 end --> <!-- 多说公共JS代码 start (一个网页只需插入一次) --> <script type="text/javascript"> var duoshuoQuery = {short_name:"wwwwebshowu"}; (function() { var ds = document.createElement('script'); ds.type = 'text/javascript';ds.async = true; ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js'; ds.charset = 'UTF-8'; (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds); })(); </script> 
    <!-- 多说公共JS代码 end --> 
  </div>
  @include('front.right_list')
</div>
@endsection
