@extends('layouts.front')

@section('content')
<div class="am-g am-g-fixed qrcode">
  <div class="am-u-sm-12 am-u-md-8 am-u-lg-8">
    <h1>{{ $site_title }}</h1>
    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-3 am-gallery-bordered" data-am-gallery="{  }" >
      @foreach ($qrcode as $str_array)
        <li>
          <div class="am-gallery-item">
              <a href="{{ url('/qrcode-'.$str_array->qr_id.'.html') }}" title="{{ $str_array->qr_name }}">
                <img class="lazy" data-original="{{ $str_array->qr_pic }}" src="{{ url('images/lazy_loading.jpg') }}" alt="{{ $str_array->qr_name }}"/>
                  <h3 class="am-gallery-title">{{ $str_array->qr_name }}</h3>
                  <div class="am-gallery-desc">{{ $str_array->updated_at->toDateString() }}</div>
              </a>
          </div>
        </li>
      @endforeach
    </ul>
    {!! $qrcode->links() !!}
  </div>
  
  @include('front.right_list')
</div>
@endsection
