@extends('layouts.front')

@section('content')
<div class="am-g am-g-fixed webdir">
  @foreach ($cates as $str)
    <div class="am-u-sm-12 am-u-md-3 am-u-lg-3">
      <div class="am-thumbnail">
        <img class="lazy" data-original="{{ $str->cate_img }}" src="{{ url('images/lazy_loading.jpg') }}" alt="{{ $str->cate_name }}"/>
        <div>
          <h3>{{ $str->cate_name }}</h3>
          <p>
            @foreach ($str['site_array'] as $str_array)
            <a target="_blank" title="{{ $str_array->cate_name }}" href="{{ url('/webdir/'.$str_array['cate_id']) }}">{{ $str_array->cate_name }}</a>
            @endforeach
          </p>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection