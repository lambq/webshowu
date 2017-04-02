@extends('layouts.admin')

@section('content')
	<div class="admin-content-body">
		<div class="am-cf am-padding am-padding-bottom-0">
			<div class="am-fl am-cf">
				<strong class="am-text-primary am-text-lg">{{ $site_nav }}</strong>
			</div>
		</div>

		<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

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
		@if(Session::has('success'))
			<div class="am-alert am-alert-success" data-am-alert>
				<button type="button" class="am-close">&times;</button>
				<p>
					{{ Session::get('success') }}
				</p>
			</div>
		@endif

		<div class="am-g">
			<form class="am-form" name="myfrom" id="myfrom" method="post" action="{{ url('pages') }}">
				<fieldset>
					{{ csrf_field() }}
					<input type="hidden" value="{{ csrf_token() }}" name="_token" />
					<input type="hidden" value="{{ $edit_id }}" name="edit_id" />

					<div class="am-form-group">
						<label for="doc-page_name">文章标题</label>
						<input type="text" name="page_name" id="doc-page_name" placeholder="请输入文章标题" value="{{ old('page_name', $pages->page_name) }}">
					</div>

					<div class="am-form-group">
						<label for="doc-page_content">文章内容</label>
						<textarea placeholder="请填写文章内容" rows="3" rows="5" id="doc-page_content" name="page_content">{{ old('page_content', $pages->page_content) }}</textarea>
					</div>

					<p><button type="submit" class="am-btn am-btn-default">提交</button></p>
				</fieldset>
			</form>
		</div>
	</div>
@endsection
