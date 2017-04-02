@extends('layouts.web')

@section('content')
<div class="am-g am-g-fixed">
  <div class="am-u-md-12 am-u-end color-margin-bottom">
    <div class="color-card color-card-bordered color-card-color">
      <div class="color-card-head">
        <div class="color-card-head-title"> <i class="am-icon-gittip"></i> {{ $page_first->page_name }}</div>
      </div>
      <div class="color-card-extra">
      </div>
      <div class="color-card-body">
        {!! $parsedown !!}
      </div>
    </div>
  </div>
</div>
@endsection
