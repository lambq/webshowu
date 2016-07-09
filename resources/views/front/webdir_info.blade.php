@extends('layouts.front')

@section('content')
<div class="am-g am-g-fixed webdir">
  <div class="am-u-sm-12 am-u-md-8 am-u-lg-8">
    <h1>{{$websites->web_name}}</h1>

    <div class="tag">
      <h3 class="am-u-sm-3 am-u-md-2 am-u-lg-2 ">标签：<em class="am-icon-tags"></em></h3>  
      <p class="am-u-sm-9 am-u-md-10 am-u-lg-10">
        @if ($webtags)
          @foreach ($webtags as $str)
            @if($str != '' && $str == 'null')
            @else
              <a target="_blank" title="{{$str}}" href="{{url('/tags/'.$str)}}">{{$str}}</a>
            @endif
          @endforeach
        @else
          还没有标签
        @endif
      </p>
    </div>

    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
    
    <p class="am-article-lead">{{ $websites->web_intro }}</p>

    <article data-am-widget="paragraph" class="am-paragraph am-paragraph-default" data-am-paragraph="{ tableScrollable: true, pureview: true }">
      <img class="lazy" data-original="http://api.webthumbnail.org/?width=480&height=330&screen=1280&url={{ $websites->web_url }}" src="{{ url('images/lazy_loading.jpg') }}" alt="{{$websites->web_name}}" class="img-rounded">
      <div class="am-scrollable-horizontal">
        <table class="am-table am-table-bordered am-table-striped am-text-nowrap">
          <tr>
            <td class="am-text-middle">网站地址：</td>
            <td>
              <a href="{{$websites->web_url}}" title="{{$websites->web_name}}" target="_blank" class="visit"><font color="#008000">{{$websites->web_url}}</font></a>
            </td>
          </tr>
          <tr>
            <td class="am-text-middle">服务器IP：</td>
            <td>{{ long2ip($websites->web_ip) }}</td>
          </tr>
          <tr>
            <td class="am-text-middle">人气：</td>
            <td>{{$websites->web_views}}</td>
          </tr>
          <tr>
            <td class="am-text-middle">PR：</td>
            <td>{{$websites->web_grank}}</td>
          </tr>
          <tr>
            <td class="am-text-middle">权重：</td>
            <td>{{$websites->web_brank}}</td>
          </tr>
          <tr>
            <td class="am-text-middle">SR：</td>
            <td>{{$websites->web_srank}}</td>
          </tr>
          <tr>
            <td class="am-text-middle">Alexas：</td>
            <td>{{$websites->web_arank}}</td>
          </tr>
          <tr>
            <td class="am-text-middle">入站：</td>
            <td>{{$websites->web_instat}}</td>
          </tr>
          <tr>
            <td class="am-text-middle">出站：</td>
            <td>{{$websites->web_outstat}}</td>
          </tr>
          <tr>
            <td class="am-text-middle">收录：</td>
            <td>{{$websites->created_at}}</td>
          </tr>
          <tr>
            <td class="am-text-middle">更新：</td>
            <td>{{$websites->updated_at}}</td>
          </tr>
          <tr>
            <td class="am-text-middle">相关查询：</td>
            <td>
              <a href="http://seo.chinaz.com/?q={{$websites->web_url}}" target="_blank">网站综合信息查询</a>　|　
              <a href="http://tool.chinaz.com/baidu/?wd={{$websites->web_url}}&lm=0&pn=0" target="_blank">百度近日收录查询</a>　|　
              <a href="http://linkche.aizhan.com/{{$websites->web_url}}/" target="_blank">友情链接查询</a>　|　
              <a href="http://pr.chinaz.com/?PRAddress={{$websites->web_url}}" target="_blank">PR查询</a>
            </td>
          </tr>
        </table>
      </div>
    </article>
    
    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />

    <!-- 多说评论框 start -->
    <div class="ds-thread" data-thread-key="{{$websites->web_id}}" data-title="{{$websites->web_name}}" data-url="/siteinfo-{{$websites->web_id}}.html"></div> <!-- 多说评论框 end --> <!-- 多说公共JS代码 start (一个网页只需插入一次) --> <script type="text/javascript"> var duoshuoQuery = {short_name:"wwwwebshowu"}; (function() { var ds = document.createElement('script'); ds.type = 'text/javascript';ds.async = true; ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js'; ds.charset = 'UTF-8'; (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds); })(); </script>
    <!-- 多说公共JS代码 end -->
  </div>

  @include('front.right_list')
</div>
@endsection
