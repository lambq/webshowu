@extends('layouts.web')

@section('content')
    <div class="am-g am-g-fixed webdir">
        <div class="color-breadcrumb">
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
        <br/>
        @foreach ($cates as $str)
            <div class="am-u-sm-12 am-u-md-3 am-u-lg-3">
                <div class="am-thumbnail">
                    <img class="lazy" data-original="{{ $str->cate_img }}" src="{{ url('images/lazy_loading.jpg') }}" alt="{{ $str->cate_name }}"/>
                    <div>
                        <h3>{{ $str->cate_name }}</h3>
                        <p>
                            @foreach ($str['site_array'] as $str_array)
                                <a target="_blank" title="{{ $str_array->cate_name }}" href="{{ url('/webdir/'.$str_array['cate_id']) }}">
                                    {{ $str_array->cate_name }}
                                </a>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection