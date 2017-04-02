@extends('layouts.web')

@section('content')
<div class="am-g am-g-fixed">
  <div class="color-breadcrumb am-u-sm-12">
    <span>
      <a class="color-breadcrumb-link" href="{{ url("/") }}">
        <i type="home" class="am-icon-home"></i>
      </a>
      <span class="color-breadcrumb-separator">/</span>
    </span>
    <span>
      <a class="color-breadcrumb-link" href="{{ url("/webdir") }}">
        <i type="user" class="am-icon-edge"></i>
        <span>秀目录</span>
      </a>
      <span class="color-breadcrumb-separator">/</span>
    </span>
    <span>
      <span class="color-breadcrumb-link">{{ $websites->web_name }}</span>
      <span class="color-breadcrumb-separator">/</span>
    </span>
  </div>
  <div class="am-u-sm-12 am-u-md-8 am-u-end color-margin-bottom">
    <div class="color-card color-card-bordered color-card-color">
      <div class="color-card-head">
        <div class="color-card-head-title">
          <i class="am-icon-edge"></i>
          {{ $websites->web_name }}
        </div>
      </div>
      <div class="color-card-extra">
        <div class="tool">
        </div>
      </div>
      <div class="color-card-body">
        <img class="lazy am-radius am-img-responsive" data-original="{{ env('APP_IMG').'/website/'.$websites->web_url }}.png" src="{{ url('images/lazy_loading.jpg') }}" alt="{{$websites->web_name}}" class="img-rounded">

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">标题 (Title)</div>
          <div class="am-u-sm-8">{{ $websites->web_name }}</div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">描述 (Description)</div>
          <div class="am-u-sm-8">{{ $websites->web_intro }}</div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">网址</div>
          <div class="am-u-sm-8">
            <a href="http://{{ $websites->web_url }}" title="{{ $websites->web_url }}" target="_blank">
              http://{{ $websites->web_url }}
            </a>
          </div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">关键词 (KeyWords)</div>
          <div class="am-u-sm-8">
            @if ($webtags)
              @foreach ($webtags as $str)
                @if($str != '' && $str == 'null')
                @else
                  <a class="am-btn am-btn-default am-round" target="_blank" title="{{$str}}" href="{{url('/tags/'.$str)}}">{{$str}}</a>
                @endif
              @endforeach
            @else
              还没有标签
            @endif
          </div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">谷歌PR</div>
          <div class="am-u-sm-8">
            <div class="am-progress color-progress">
              <div class="am-progress-bar color-progress-bar am-progress-bar-secondary" style="width:{{ $websites->web_grank }}0%"></div>
            </div>
          </div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">百度权重</div>
          <div class="am-u-sm-8">
            <div class="am-progress color-progress">
              <div class="am-progress-bar color-progress-bar am-progress-bar-secondary" style="width:{{ $websites->web_brank }}0%"></div>
            </div>
          </div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">搜狗评级</div>
          <div class="am-u-sm-8">
            <div class="am-progress color-progress">
              <div class="am-progress-bar color-progress-bar am-progress-bar-secondary" style="width:{{ $websites->web_srank }}0%"></div>
            </div>
          </div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">服务器IP</div>
          <div class="am-u-sm-8">{{ long2ip($websites->web_ip) }}</div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">人气</div>
          <div class="am-u-sm-8">{{ $websites->web_views }}</div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">Alexas</div>
          <div class="am-u-sm-8">{{ $websites->web_arank }}</div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">入站</div>
          <div class="am-u-sm-8">{{ $websites->web_instat }}</div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">出站</div>
          <div class="am-u-sm-8">{{ $websites->web_outstat }}</div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">收录</div>
          <div class="am-u-sm-8">{{ $websites->created_at }}</div>
        </div>

        <div class="am-u-sm-12">
          <div class="am-u-sm-4">更新</div>
          <div class="am-u-sm-8">{{ $websites->updated_at }}</div>
        </div>

        <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
        <a class="am-btn am-btn-success am-radius" title="网站综合查询" href='{{ url("/seo/$websites->web_url") }}' target="_blank">
          网站综合查询
        </a>

      </div>
    </div>
  </div>
  @include('web.right_list')
</div>
@endsection
