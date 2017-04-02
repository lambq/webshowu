@extends('layouts.web')

@section('content')
    <div class="am-g am-g-fixed">
        <div class="am-u-sm-12 am-u-end color-breadcrumb color-margin-bottom">
            <span>
                <a class="color-breadcrumb-link" href="{{ url('/') }}">
                    <i type="home" class="am-icon-home"></i>
                </a>
                <span class="color-breadcrumb-separator">/</span>
            </span>
            <span>
                <a class="color-breadcrumb-link" href="{{ url('/seo') }}">
                    <i type="user" class="am-icon-file"></i>
                    <span>网站综合查询</span>
                </a>
                <span class="color-breadcrumb-separator">/</span>
            </span>
        </div>
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
            <form action="{{ url('/seo') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                <div class="am-input-group">
                    <span class="am-input-group-label">http://</span>
                    <input type="text" name="site" class="am-form-field" @if($action == 'update') value="{{ $site->web_url }}" @endif>
                    <span class="am-input-group-btn">
                    <button class="am-btn am-btn-default" type="submit">seo查询</button>
                </span>
                </div>
            </form>
        </div>
        @if($action == 'index')
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
                            <a href='{{ url("/seo/$v->web_url") }}' target="_blank" title="{{ $v->web_url }}">{{ $v->web_url }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if($action == 'update')
            <div class="am-u-md-12 am-u-end color-margin-bottom">
                <div class="color-card color-card-bordered color-card-color">
                    <div class="color-card-head">
                        <div class="color-card-head-title"> <i class="am-icon-hacker-news"></i> {{ $site->web_url }}网站基本信息 </div>
                    </div>
                    <div class="color-card-extra">
                        最后更新：{{ $site->updated_at }}
                    </div>
                    <div class="color-card-body am-nbfc">
                        <div class="am-u-sm-12 am-u-md-3">
                            <img class="lazy am-radius am-img-responsive" data-original="{{ env('APP_IMG').'/website/'.$site->web_url }}.png" src="{{ url('images/lazy_loading.jpg') }}" alt="{{$site->web_name}}" class="img-rounded">
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
                        <div class="color-card-head-title"> <i class="am-icon-hacker-news"></i> {{ $site->web_url }}服务器信息 </div>
                    </div>
                    <div class="color-card-extra"></div>
                    <div class="color-card-body am-nbfc">
                        <ul class="am-avg-sm-1 am-avg-md-3 am-avg-lg-3 am-thumbnails">
                            <li>协议类型： @if(array_key_exists('host', $serv)){{ $serv['host'] }} @else 0 @endif</li>
                            <li>页面类型： @if(array_key_exists('Content-Type', $serv)){{ $serv['Content-Type'] }} @else 0 @endif</li>
                            <li>服务器类型：@if(array_key_exists('Server', $serv)){{ $serv['Server'] }} @else 0 @endif</li>
                            <li>程序支持：@if(array_key_exists('X-Powered-By', $serv)){{ $serv['X-Powered-By'] }} @else 0 @endif</li>
                            <li>创建时间：@if(array_key_exists('Date', $serv)){{ $serv['Date'] }} @else 0 @endif</li>
                            <li>网页是否压缩：@if(array_key_exists('Vary', $serv)) 是 @else 否 @endif</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="am-u-md-12 am-u-end color-margin-bottom">
                <div class="color-card color-card-bordered color-card-color">
                    <div class="color-card-head">
                        <div class="color-card-head-title"> <i class="am-icon-hacker-news"></i> {{ $site->web_url }}备案信息 </div>
                    </div>
                    <div class="color-card-extra"></div>
                    <div class="color-card-body am-nbfc">
                        @if(array_key_exists('domainbeian', $list))
                            <ul class="am-avg-sm-1 am-avg-md-3 am-avg-lg-3 am-thumbnails">
                                <li>主办单位名称： {{ $list['domainbeian']['organizers'] }}</li>
                                <li>主办单位性质： {{ $list['domainbeian']['organizers_type'] }}</li>
                                <li>网站备案/许可证号：{{ $list['domainbeian']['icpno'] }}</li>
                                <li>网站名称：{{ $list['domainbeian']['sitenm'] }}</li>
                                <li>网站首页网址：{{ $list['domainbeian']['domain'] }}</li>
                                <li>审核时间：{{ $list['domainbeian']['exadate'] }} </li>
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
                        <div class="color-card-head-title"> <i class="am-icon-hacker-news"></i> {{ $site->web_url }}&alexa信息 </div>
                    </div>
                    <div class="color-card-extra">

                    </div>
                    <div class="color-card-body">
                        @if(array_key_exists('alexa_check', $list))
                            <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-thumbnails">
                                <li>流量排名-三个月：{{ $list['alexa_check']['reach_rank'] }} </li>
                                <li>访量排名-三个月：{{ $list['alexa_check']['traffic_rank'] }} </li>
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
                        <div class="color-card-head-title"> <i class="am-icon-eye"></i> {{ $site->web_url }}网站权重 </div>
                    </div>
                    <div class="color-card-extra"></div>
                    <div class="color-card-body">
                        @if(array_key_exists('domainrank', $list))
                            <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 am-thumbnails">
                                <li>
                                    谷歌权重：{{ $list['domainrank']['google'] }}
                                </li>
                                <li>
                                    百度权重：{{ $list['domainrank']['baidu'] }}
                                </li>
                                <li>
                                    360权重：{{ $list['domainrank']['so'] }}
                                </li>
                                <li>
                                    搜狗权重：{{ $list['domainrank']['sogou'] }}
                                </li>
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
                        <div class="color-card-head-title"> <i class="am-icon-eye"></i> {{ $site->web_url }}网站的收录/反链结果 </div>
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
                        @if(array_key_exists('domainbacklink',$list))
                            <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-6 am-thumbnails">
                                <li>
                                    <p>
                                        谷歌收录：{{ $list['domainindexd']['google'] }}
                                    </p>
                                    <p>
                                        谷歌反链：{{ $list['domainbacklink']['google'] }}
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        bing收录：{{ $list['domainindexd']['bing'] }}
                                    </p>
                                    <p>
                                        bing反链：{{ $list['domainbacklink']['bing'] }}
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        yahoo收录：{{ $list['domainindexd']['yahoo'] }}
                                    </p>
                                    <p>
                                        yahoo反链：{{ $list['domainbacklink']['yahoo'] }}
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        百度收录：{{ $list['domainindexd']['baidu'] }}
                                    </p>
                                    <p>
                                        百度反链：{{ $list['domainbacklink']['baidu'] }}
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        360收录：{{ $list['domainindexd']['so'] }}
                                    </p>
                                    <p>
                                        360反链：{{ $list['domainbacklink']['so'] }}
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        搜狗收录：{{ $list['domainindexd']['sogou'] }}
                                    </p>
                                    <p>
                                        搜狗反链：{{ $list['domainbacklink']['sogou'] }}
                                    </p>
                                </li>
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
                        <div class="color-card-head-title"> <i class="am-icon-eye"></i> {{ $site->web_url }}域名的信息 </div>
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
                        @else
                            <p>数据还在更新中……</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection