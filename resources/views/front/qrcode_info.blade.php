@extends('layouts.front')

@section('content')
<div class="am-g am-g-fixed qrcode">
  <div class="am-u-sm-12 am-u-md-8 am-u-lg-8">
    <h1>{{ $qrcode->qr_name }}</h1>

    <div class="tag">
      <h3 class="am-u-sm-12 am-u-md-2 am-u-lg-2">标签：<em class="am-icon-tags"></em></h3>  
      <p class="am-u-sm-12 am-u-md-10 am-u-lg-10">
        @foreach (get_tags($qrcode->qr_tags,false) as $str)
          <a target="_blank" title="{{$str}}" href="http://zhannei.baidu.com/cse/search?q={{$str}}&s=5924146839921945097">{{$str}}</a>
        @endforeach
      </p>
    </div>

    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />

    <div class="am-u-sm-12 am-u-md-4 am-u-lg-4">
      <figure data-am-widget="figure" class="am am-figure am-figure-default "   data-am-figure="{  pureview: 'true' }">
      <img class="lazy" data-original="{{ $qrcode->qr_img }}" src="{{ url('images/lazy_loading.jpg') }}" data-rel="{{ $qrcode->qr_img }}" alt="{{ $qrcode->qr_name }}"/>
        <figcaption class="am-figure-capition-btm">
          放心扫码，扫一扫
        </figcaption>
      </figure>
    </div>
    
    <div class="am-u-sm-12 am-u-md-8 am-u-lg-8">
      <div class="am-scrollable-horizontal">
        <table class="am-table am-table-bordered am-table-striped am-text-nowrap">
          <tr>
            <td class="am-text-middle">简介 ：</td>
            <td>
              {{ $qrcode->qr_intro }}
            </td>
          </tr>
          <tr>
            <td class="am-text-middle">群主 ：</td>
            <td>
              {{ $qrcode->qr_pubname }}
            </td>
          </tr>
          <tr>
            <td class="am-text-middle">发布时间 ：</td>
            <td>
              {{ $qrcode->updated_at }}
            </td>
          </tr>
          <tr>
            <td class="am-text-middle">关注度 ：</td>
            <td>
              {{ $qrcode->qr_views }}
            </td>
          </tr>
        </table>
      </div>
    </div>

    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
      <!--上一篇，下一篇-->
      <p>上一篇：@if ($prev)<a href="{{ url('/qrcode-'.$prev->qr_id.'.html') }}">{{$prev->qr_name}}</a> @else 没有了 @endif </p>
      <p>下一篇：@if ($next)<a href="{{ url('/qrcode-'.$next->qr_id.'.html') }}">{{$next->qr_name}}</a> @else 没有了 @endif </p>
    </div>

    <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
    <div class="ds-thread" data-thread-key="{{$qrcode->qr_id}}" data-title="{{$qrcode->qr_name}}" data-url='{{ url("/qrcode-$qrcode->qr_id") }}.html'></div> <!-- 多说评论框 end -->  <script type="text/javascript"> var duoshuoQuery = {short_name:"wwwwebshowu"}; (function() { var ds = document.createElement('script'); ds.type = 'text/javascript';ds.async = true; ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js'; ds.charset = 'UTF-8'; (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds); })(); </script> 
    <!-- 多说公共JS代码 end --> 
  </div>

  @include('front.right_list')
</div>
@endsection
