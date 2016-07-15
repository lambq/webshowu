@extends('layouts.admin')

@section('content')
	<div class="admin-content-body">
		<div class="am-cf am-padding am-padding-bottom-0">
			<div class="am-fl am-cf">
				<strong class="am-text-primary am-text-lg">{{ $site_nav }}</strong>
			</div>
		</div>

		<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

		<div class="am-g">
				@if(count($errors) > 0)
					<div class="am-alert am-alert-danger" data-am-alert>
						<button type="button" class="am-close">&times;</button>
						<p>
							@foreach($errors->all() as $error)
							{{ $error }} &nbsp;&nbsp;
							@endforeach
						</p>
					</div>
				@endif

				<form class="am-form" name="myfrom" id="myfrom" method="post" action="{{ url('/admin/webdir') }}">
					<fieldset>
						{{ csrf_field() }}
						<input type="hidden" value="{{ csrf_token() }}" name="_token" />
						<input type="hidden" value="{{ $edit_id }}" name="edit_id" />
						<input type="hidden" value="{{ $web->user_id }}" name="user_id" />

						<div class="am-form-group">
							<label for="doc-select-1">选择分类</label>
							<select id="doc-select-1" name="cate_id">
								{!! $category_option !!}
							</select>
							<span class="am-form-caret"></span>
						</div>

						<div class="am-form-group">
							<label for="doc-web_name">网站名称</label>
							<input type="text" name="web_name" id="doc-web_name" placeholder="请输入网站名称" value="{{$web->web_name}}">
						</div>

						<div class="am-form-group">
							<label for="doc-web_url">网站域名</label>
							<input type="text" name="web_url" id="doc-web_url" placeholder="例如：http://www.demo.com" value="{{$web->web_url}}">
						</div>

						<div class="am-form-group">
							<label for="doc-web_tags">TAG标签</label>
							<input type="text" name="web_tags" id="doc-web_tags" placeholder="请输入TAG标签" value="{{$web->web_tags}}">
						</div>

						<div class="am-form-group">
							<label for="doc-web_intro">网站简介</label>
							<textarea placeholder="请填写网站简介" rows="3" rows="5" id="doc-web_intro" name="web_intro">{{$web->web_intro}}</textarea>
						</div>

						<div class="am-form-group">
							<label for="doc-web_ip">服务器IP</label>
							<input type="text" name="web_ip" id="doc-web_ip" placeholder="请输入网站域名" value="{{ long2ip($web->web_ip) }}">
						</div>

						<div class="am-form-group">
							<label for="doc-web_grank">PageRank</label>
							<input type="text" name="web_grank" id="doc-web_grank" placeholder="请输入PageRank" value="{{$web->web_grank}}">
						</div>

						<div class="am-form-group">
							<label for="doc-web_brank">BaiduRank</label>
							<input type="text" name="web_brank" id="doc-web_brank" placeholder="请输入BaiduRank" value="{{$web->web_brank}}">
						</div>

						<div class="am-form-group">
							<label for="doc-web_srank">SogouRank</label>
							<input type="text" name="web_srank" id="doc-web_srank" placeholder="请输入web_srank" value="{{$web->web_srank}}">
						</div>

						<div class="am-form-group">
							<label for="doc-web_arank">AlexaRank</label>
							<input type="text" name="web_arank" id="doc-web_arank" placeholder="请输入AlexaRank" value="{{$web->web_arank}}">
						</div>

						<p><button type="submit" class="am-btn am-btn-default">提交</button></p>
					</fieldset>
				</form>
		</div>
	</div>
@endsection
