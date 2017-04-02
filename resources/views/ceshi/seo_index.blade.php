@extends('layouts.web')

@section('content')
<div class="am-g am-g-fixed">
    <div class="am-u-md-12 am-u-end color-margin-bottom">
        @if(count($errors) > 0)
            <div class="am-alert am-alert-danger" data-am-alert>
                <button type="button" class="am-close">&times;</button>
                <p>
                    @foreach($errors->all() as $error)
                        {{ $error }} &nbsp;&nbsp;
                    @endforeach
                </p>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="am-alert am-alert-success" data-am-alert>
                <button type="button" class="am-close">&times;</button>
                <p>
                    {{ Session::get('success') }}
                </p>
            </div>
        @endif
        <form action="{{ url('ceshi/seo') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
            <div class="am-input-group">
                <span class="am-input-group-label">http://</span>
                <input type="text" name="site" class="am-form-field" @if($site_nav == 'update') value="{{ $site->web_url }}" @endif>
                <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" type="submit">seo查询</button>
                </span>
            </div>
        </form>
    </div>
    @if($site_nav == 'index')
        <div class="am-u-md-12 am-u-end color-margin-bottom">
            <div class="color-card color-card-bordered color-card-color">
                <div class="color-card-head">
                    <div class="color-card-head-title"> <i class="am-icon-hacker-news"></i> 最近查询网站 </div>
                </div>
                <div class="color-card-extra">
                    <div class="tool">
                        <a href="javascript:;" class="collapse active"> </a>
                        <a href="javascript:;" class="config"> </a>
                        <a href="javascript:;" class="reload"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="color-card-body am-nbfc">
                    @foreach($site as $v)
                        <a href='{{ url("/ceshi/seo/$v->web_url") }}' target="_blank" title="{{ $v->web_url }}">http://{{ $v->web_url }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if($site_nav == 'update')
        <div class="am-u-md-12 am-u-end color-margin-bottom">
            <div class="color-card color-card-bordered color-card-color">
                <div class="color-card-head">
                    <div class="color-card-head-title"> <i class="am-icon-hacker-news"></i> 网站基本信息 </div>
                </div>
                <div class="color-card-extra">
                    <div class="tool">
                        <a href="javascript:;" class="collapse active"> </a>
                        <a href="javascript:;" class="config"> </a>
                        <a href="javascript:;" class="reload"> </a>
                        <a href="javascript:;" class="remove"> </a>
                    </div>
                </div>
                <div class="color-card-body am-nbfc">
                    <div class="am-u-sm-12 am-u-md-3">
                        <img class="lazy am-radius am-img-responsive" data-original="https://jietu.zzs1.com/?a={{ $site->web_url }}&w=480&h=330" src="{{ url('images/lazy_loading.jpg') }}" alt="{{$site->web_name}}" class="img-rounded">
                    </div>
                    <div class="am-u-sm-12 am-u-md-9">
                        <p>标题：@if(property_exists($site, 'web_name')) {{ $site->web_name }} @endif</p>
                        <p>关键词：@if(property_exists($site, 'web_tags')) {{ $site->web_tags }} @endif</p>
                        <p>简介：@if(property_exists($site, 'web_intro')) {{ $site->web_intro }} @endif</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="am-u-md-12 am-u-end color-margin-bottom">
            <div class="color-card color-card-bordered color-card-color">
                <div class="color-card-head">
                    <div class="color-card-head-title"> <i class="am-icon-hacker-news"></i> alexa </div>
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
                    @if(array_key_exists('alexa_check', $list))
                        <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-thumbnails">
                            <li>流量排名-三个月：{{ $list['alexa_check']['reach_rank'] }}</li>
                            <li>访量排名-三个月：{{ $list['alexa_check']['traffic_rank'] }}</li>
                        </ul>
                    @else
                        数据还在更新中……
                    @endif
                </div>
            </div>
        </div>
        <div class="am-u-md-12 am-u-end color-margin-bottom">
            <div class="color-card color-card-bordered color-card-color">
                <div class="color-card-head">
                    <div class="color-card-head-title"> <i class="am-icon-eye"></i> 网站权重 </div>
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
                    <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-thumbnails">
                        <li>
                            谷歌权重：
                            @if(array_key_exists('google_page_rank_check', $list))
                                {{ $list['google_page_rank_check'] }}
                            @else
                                0
                            @endif
                        </li>
                        <li>
                            百度权重：
                            @if(array_key_exists('baidu_rank_check', $list))
                                {{ $list['baidu_rank_check'] }}
                            @else
                                0
                            @endif
                        </li>
                        <li>
                            360权重：
                            @if(array_key_exists('so_rank_check', $list))
                                {{ $list['so_rank_check'] }}
                            @else
                                0
                            @endif
                        </li>
                        <li>
                            搜狗权重：
                            @if(array_key_exists('sogou_rank_check', $list))
                                {{ $list['sogou_rank_check'] }}
                            @else
                                0
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="am-u-md-12 am-u-end color-margin-bottom">
            <div class="color-card color-card-bordered color-card-color">
                <div class="color-card-head">
                    <div class="color-card-head-title"> <i class="am-icon-eye"></i> 网站的收录/反链结果 </div>
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
                    <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-6 am-thumbnails">
                        <li>
                            <p>
                                谷歌收录：
                                @if(array_key_exists('google_index_check', $list))
                                    {{ $list['google_index_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                            <p>
                                谷歌反链：
                                @if(array_key_exists('google_backlink_check', $list))
                                    {{ $list['google_backlink_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                        </li>
                        <li>
                            <p>
                                bing收录：
                                @if(array_key_exists('bing_index_check', $list))
                                    {{ $list['bing_index_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                            <p>
                                bing反链：
                                @if(array_key_exists('bing_backlink_check', $list))
                                    {{ $list['bing_backlink_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                        </li>
                        <li>
                            <p>
                                yahoo收录：
                                @if(array_key_exists('yahoo_index_check', $list))
                                    {{ $list['yahoo_index_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                            <p>
                                yahoo反链：
                                @if(array_key_exists('yahoo_backlink_check', $list))
                                    {{ $list['yahoo_backlink_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                        </li>
                        <li>
                            <p>
                                百度收录：
                                @if(array_key_exists('baidu_index_check', $list))
                                    {{ $list['baidu_index_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                            <p>
                                百度反链：
                                @if(array_key_exists('baidu_backlink_check', $list))
                                    {{ $list['baidu_backlink_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                        </li>
                        <li>
                            <p>
                                360收录：
                                @if(array_key_exists('so_index_check', $list))
                                    {{ $list['so_index_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                            <p>
                                360反链：
                                @if(array_key_exists('so_backlink_check', $list))
                                    {{ $list['so_backlink_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                        </li>
                        <li>
                            <p>
                                搜狗收录：
                                @if(array_key_exists('sogou_index_check', $list))
                                    {{ $list['sogou_index_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                            <p>
                                搜狗反链：
                                @if(array_key_exists('sogou_backlink_check', $list))
                                    {{ $list['sogou_backlink_check'] }}
                                @else
                                    0
                                @endif
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="am-u-md-12 am-u-end color-margin-bottom">
            <div class="color-card color-card-bordered color-card-color">
                <div class="color-card-head">
                    <div class="color-card-head-title"> <i class="am-icon-eye"></i> 域名{{ $site->web_url }}的信息 </div>
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
                    @if(array_key_exists('whois_check', $list))
                        <p>状态：{{ $list['whois_check']['is_registered'] }}</p>
                        <p>dns：{{ $list['whois_check']['name_servers'] }}</p>
                        <p>创建时间：{{ $list['whois_check']['created_at'] }}</p>
                        <p>更新时间：{{ $list['whois_check']['changed_at'] }}</p>
                        <p>过期时间：{{ $list['whois_check']['expire_at'] }}</p>
                        <p>域名服务器：{{ $list['whois_check']['registrar_url'] }}</p>
                        <p>联系人：{{ $list['whois_check']['registrant_name'] }}</p>
                        <p>联系邮箱：{{ $list['whois_check']['registrant_email'] }}</p>
                        <p>{{ $list['whois_check']['rawdata'] }}</p>
                    @else
                        <p>数据还在更新中……</p>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
@endsection