@extends('layouts.front')

@section('content')
<link href="{{ url('css/timeline.css') }}" rel='stylesheet' type='text/css'>
<header>
	<h1>{{ $users->name }}的秀足迹</h1>
</header>
<section id="cd-timeline" class="cd-container">
	@foreach ($lists as $str)
	<div class="cd-timeline-block">
		@if($str['type'] == 'art')
		<div class="cd-timeline-img cd-location">
			<img src="images/cd-icon-location.svg" alt="Location">
		</div>
		<div class="cd-timeline-content">
			<h2>{{$str['title']}}</h2>
			<p>{{$str['intro']}}</p>
			<a title="{{$str['title']}}" target="_blank" href="{{ url('/artinfo-'.$str['id'].'.html') }}" class="cd-read-more">阅读更多</a>
			<span class="cd-date">{{$str['updated_at']}}</span>
		</div> 
		@endif
		@if($str['type'] == 'img')
		<div class="cd-timeline-img cd-picture">
			<img src="images/cd-icon-picture.svg" alt="Picture">
		</div>
		<div class="cd-timeline-content">
			<h2>{{$str['title']}}</h2>
			<img class="lazy" data-original="http://api.webthumbnail.org/?width=480&height=330&screen=1280&url={{ $str['web_url'] }}" src="{{ url('images/lazy_loading.jpg') }}" alt="{{$str['title']}}"/>
			<p>{{$str['intro']}}</p>
			<a title="{{$str['title']}}" target="_blank" href="{{ url('/siteinfo-'.$str['id'].'.html') }}" class="cd-read-more">阅读更多</a>
			<span class="cd-date">{{$str['updated_at']}}</span>
		</div> 
		@endif
	</div>
	@endforeach
	<!-- 
	<div class="cd-timeline-block">
		<div class="cd-timeline-img cd-movie">
			<img src="public/images/cd-icon-movie.svg" alt="Movie">
		</div> 

		<div class="cd-timeline-content">
			<h2>17素材网 2</h2>
			<p>17素材网专注于提供免费素材下载,其内容涵盖设计素材,PSD素材,矢量素材,图片素材,图标素材,设计字体等免费素材.下载免费素材尽在17素材网免费素材网</p>
			<a href="http://www.sucaijiayuan.com" class="cd-read-more">阅读更多</a>
			<span class="cd-date">Jan 18</span>
		</div> 
	</div>  
	-->
</section>
@endsection
