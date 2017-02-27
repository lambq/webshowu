@extends('layouts.web')

@section('content')
<div class="am-g am-g-fixed">
    <div class="am-u-sm-12 am-u-md-8 am-u-lg-8 am-u-end color-margin-bottom">
        <div class="color-card color-card-bordered color-card-color">
            <div class="color-card-head">
                <div class="color-card-head-title am-text-danger"> <i class="am-icon-github"></i> {{ $site_title }} </div>
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
                            <!--缩略图在标题左边-->
                            @foreach ($articles as $v)
                                <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                                    <div class="am-u-sm-4 am-list-thumb">
                                        <a href="{{ url('/artinfo-'.$v->art_id.'.html') }}" title="{{ $v->art_title }}" target="_blank">
                                            <img class="lazy" width="168" height="113" data-original="{{ $v->art_thumbnail }}" src="{{ url('images/lazy_loading.jpg') }}" alt="{{ $v->art_title }}"/>
                                        </a>
                                    </div>
                                    <div class=" am-u-sm-8 am-list-main">
                                        <h3 class="am-list-item-hd">
                                            <a href="{{ url('/artinfo-'.$v->art_id.'.html') }}" title="{{ $v->art_title }}" target="_blank">
                                                {{ $v->art_title }}
                                            </a>
                                        </h3>
                                        <div class="am-list-item-text">
                                            @foreach (explode(',', $v->art_tags) as $vv)
                                                <a class="am-btn am-btn-default am-radius" href="http://zhannei.baidu.com/cse/search?q={{ $vv }}&s=5924146839921945097" title="{{ $vv }}" target="_blank">
                                                    {{ str_limit( $vv ,10,'') }}
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="am-list-item-text am-text-right">
                                            <em class="am-icon-clock-o">{{ $v->updated_at->toDateString() }}</em>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                {!! $articles->links() !!}
            </div>
        </div>
    </div>
    @include('web.right_list')
</div>
@endsection
