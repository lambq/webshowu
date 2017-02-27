@extends('layouts.web')

@section('content')
<div class="am-g am-g-fixed index">
    <div class="am-u-md-8 am-u-end color-margin-bottom">
        <div class="color-card color-card-bordered color-card-color">
            <div class="color-card-head">
                <div class="color-card-head-title am-text-danger"> <i class="am-icon-thumbs-up"></i> 推荐网站 </div>
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
                <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-2 am-avg-lg-5 am-gallery-bordered" data-am-gallery="{  }" >
                    @foreach($bestsites as $v)
                        <li>
                            <div class="am-gallery-item">
                                <a title="{{ $v->web_name }}" target="_blank" href="{{ url("siteinfo-$v->web_id.html") }}">
                                    <img class="lazy" data-original="http://api.webthumbnail.org/?width=480&height=330&screen=1280&url={{ $v->web_url }}" src="{{ url('images/lazy_loading.jpg') }}"  alt="{{ $v->web_name }}"/>
                                    <h3 class="am-gallery-title am-text-center">{{ $v->web_name }}</h3>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
        <br/>
        <div class="color-card color-card-bordered color-card-color">
            <div class="color-card-head">
                <div class="color-card-head-title am-text-primary"> <i class="am-icon-thumbs-up"></i> 推荐资讯 </div>
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
                <ul class="am-avg-sm-2 am-avg-md-2 am-avg-lg-4 am-thumbnails">
                    @foreach ($articles as $v)
                        <li class="am-text-success am-text-truncate">
                            <a href="{{ url("artinfo-$v->art_id.html") }}" target="_blank" title="{{ $v->art_title }}">{{ $v->art_title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <br/>
        <div class="color-card color-card-bordered color-card-color">
            <div class="color-card-head">
                <div class="color-card-head-title am-text-warning"> <i class="am-icon-spinner"></i> 等待审核 </div>
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
                <ul class="am-avg-sm-2 am-avg-md-4 am-avg-lg-6 am-thumbnails">
                    @foreach ($web_status as $v)
                        <li class="am-text-success am-text-truncate">
                            <a href="{{ url("siteinfo-$v->web_id.html") }}" target="_blank" title="{{ $v->web_name }}">{{ $v->web_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <br/>
        <div class="color-card color-card-bordered color-card-color">
            <div class="color-card-head">
                <div class="color-card-head-title am-text-secondary"> <i class="am-icon-random"></i> 随机网站 </div>
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
                <ul class="am-avg-sm-2 am-avg-md-4 am-avg-lg-6 am-thumbnails">
                    @foreach ($randsites as $v)
                        <li class="am-text-success am-text-truncate">
                            <a href="{{ url("siteinfo-$v->web_id.html") }}" target="_blank" title="{{ $v->web_name }}">{{ $v->web_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="am-u-md-4 am-u-end color-margin-bottom">
        <div class="color-card color-card-bordered color-card-color">
            <div class="color-card-head">
                <div class="color-card-head-title"> <i class="am-icon-hacker-news"></i> 最新点入 </div>
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
                            @foreach($newsites as $v)
                                <li class="am-g am-list-item-dated">
                                    <a title="{{ $v->web_name }}" target="_blank" href="{{ url("siteinfo-$v->web_id.html") }}" class="am-list-item-hd ">{{ $v->web_name }}</a>
                                    <span class="am-list-date">{{ $v->created_at->toDateString() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="color-card color-card-bordered color-card-color">
            <div class="color-card-head">
                <div class="color-card-head-title"> <i class="am-icon-eye"></i> 人气网站 </div>
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
                            @foreach($viewsites as $v)
                                <li class="am-g am-list-item-dated">
                                    <a title="{{ $v->web_name }}" target="_blank" href="{{ url("siteinfo-$v->web_id.html") }}" class="am-list-item-hd ">{{ $v->web_name }}</a>
                                    <span class="am-list-date">{{ $v->created_at->toDateString() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="am-u-sm-12 am-u-end color-margin-bottom">
        <div class="color-card color-card-bordered color-card-color">
            <div class="color-card-head">
                <div class="color-card-head-title"> <i class="am-icon-at"></i> 友情链接 </div>
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
                <ul class="am-avg-sm-2 am-avg-md-4 am-avg-lg-6 am-thumbnails">
                    @foreach ($links as $v)
                        <li class="am-text-success">
                            <a href="{{ $v->link_url }}" target="_blank" title="{{ $v->link_name }}">{{ $v->link_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
