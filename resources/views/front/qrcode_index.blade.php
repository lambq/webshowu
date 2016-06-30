@extends('layouts.front')

@section('content')
<div class="am-g am-g-fixed qrcode">
  @foreach ($cates as $str)
    <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default" >
        <h2 class="am-titlebar-title ">
            {{ $str->cate_name }}
        </h2>
        <nav class="am-titlebar-nav">
            <a title="{{ $str->cate_name }}" href="{{ url('/qrcode/'.$str->cate_dir ) }}" class="">更多 &raquo;</a>
        </nav>
    </div>
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-6 am-gallery-bordered" data-am-gallery="{  }" >
      @foreach ($str['site_array'] as $str_array)
        <li>
          <div class="am-gallery-item">
              <a href="{{ url('/qrcode-'.$str_array->qr_id.'.html') }}" title="{{ $str_array->qr_name }}">
                <img class="lazy" data-original="{{ $str_array->qr_pic }}" src="{{ url('images/lazy_loading.jpg') }}"  alt="{{ $str_array->qr_name }}"/>
                  <h3 class="am-gallery-title">{{ $str_array->qr_name }}</h3>
                  <div class="am-gallery-desc">{{ $str_array->updated_at->toDateString() }}</div>
              </a>
          </div>
        </li>
      @endforeach
    </ul>
  @endforeach
</div>
@endsection