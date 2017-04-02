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
                <a class="color-breadcrumb-link" href="{{ url('/webdir') }}">
                    <i type="user" class="am-icon-file"></i>
                    <span>秀目录</span>
                </a>
                <span class="color-breadcrumb-separator">/</span>
            </span>
        </div>
        @foreach ($cates as $v)
            <div class="am-u-md-12 am-u-end color-margin-bottom">
            <div class="color-card color-card-bordered color-card-color">
                <div class="color-card-head">
                    <div class="color-card-head-title"> <i class="am-icon-hacker-news"></i> {{ $v->cate_name }} </div>
                </div>
                <div class="color-card-extra">

                </div>
                <div class="color-card-body am-nbfc">
                    <ul class="am-avg-sm-4 am-avg-md-6 am-avg-lg-6 am-thumbnails">
                        @foreach ($v['site_array'] as $vv)
                            <li>
                                <a target="_blank" title="{{ $vv->cate_name }}" href="{{ url('/webdir/'.$vv['cate_id']) }}">
                                    {{ $vv->cate_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
            {{--<div class="am-u-sm-12 am-u-md-3 am-u-lg-3">--}}
                {{--<div class="am-thumbnail">--}}
                    {{--<img class="lazy" data-original="{{ $str->cate_img }}" src="{{ url('images/lazy_loading.jpg') }}" alt="{{ $str->cate_name }}"/>--}}
                    {{--<div>--}}
                        {{--<h3>{{ $str->cate_name }}</h3>--}}
                        {{--<p>--}}
                            {{--@foreach ($str['site_array'] as $str_array)--}}
                                {{--<a target="_blank" title="{{ $str_array->cate_name }}" href="{{ url('/webdir/'.$str_array['cate_id']) }}">--}}
                                    {{--{{ $str_array->cate_name }}--}}
                                {{--</a>--}}
                            {{--@endforeach--}}
                        {{--</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
    </div>
@endsection