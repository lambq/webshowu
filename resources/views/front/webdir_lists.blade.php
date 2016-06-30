@extends('layouts.front')

@section('content')
<div class="am-g am-g-fixed webdir">
  <div class="am-u-sm-12 am-u-md-8 am-u-lg-8">
    <h1>{{ $site_title }}</h1>
    <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-avg-lg-3 am-gallery-bordered" data-am-gallery="{  }" >
      @foreach ($websites as $str)
      <li>
        <div class="am-gallery-item">
            <a href="{{ url('/siteinfo-'.$str->web_id.'.html') }}" title="{{$str->web_name}}" target="_blank">
              <img class="lazy" data-original="http://api.webthumbnail.org/?width=480&height=330&screen=1280&url={{ $str->web_url }}" src="{{ url('images/lazy_loading.jpg') }}" src=""  alt="{{ $str->web_name }}"/>
                <h3 class="am-gallery-title">{{ $str->web_name }}</h3>
                <div class="am-gallery-desc">{{ $str->updated_at->toDateString() }}</div>
            </a>
        </div>
      </li>
      @endforeach
    </ul>
    {!! $websites->links() !!}
  </div>

  @include('front.right_list')
</div>  
@endsection
