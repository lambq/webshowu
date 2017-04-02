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
				<form class="am-form" name="myfrom" id="myfrom" method="post" action="{{ url('article') }}">
					<fieldset>
						{{ csrf_field() }}
						<input type="hidden" value="{{ csrf_token() }}" name="_token" />
						<input type="hidden" value="{{ $edit_id }}" name="edit_id" />
						<input type="hidden" value="{{ $article->user_id }}" name="user_id" />

						<div class="am-form-group">
							<label for="doc-select-1">选择分类</label>
							<select id="doc-select-1" name="cate_id">
								{!! $category_option !!}
							</select>
							<span class="am-form-caret"></span>
						</div>

						<div class="am-form-group">
							<label for="doc-art_title">文章标题</label>
							<input type="text" name="art_title" id="doc-art_title" placeholder="请输入文章标题" value="{{ old('art_title', $article->art_title) }}">
						</div>

						<div class="am-form-group">
							<label for="doc-copy_from">来源名称</label>
							<input type="text" name="copy_from" id="doc-copy_from" placeholder="请输入来源名称" value="{{ old('copy_from', $article->copy_from) }}">
						</div>

						<div class="am-form-group">
							<label for="doc-org_url">采集地址</label>
							<input type="text" name="org_url" id="doc-org_url" placeholder="请输入采集地址" value="{{ old('org_url', $article->org_url) }}">
						</div>

						<div class="am-form-group">
							<label for="doc-copy_url">来源地址</label>
							<input type="text" name="copy_url" id="doc-copy_url" placeholder="请输入来源地址" value="{{ old('copy_url', $article->copy_url) }}">
						</div>

						<div class="am-form-group">
							<label for="doc-art_tags">文章标签</label>
							<input type="text" name="art_tags" id="doc-art_tags" placeholder="请输入文章标签" value="{{ old('art_tags', $article->art_tags) }}">
						</div>

						<div class="am-form-group">
							<label for="doc-art_intro">文章简介</label>
							<textarea placeholder="请填写文章简介" rows="3" rows="5" id="doc-art_intro" name="art_intro">{{ old('art_intro', $article->art_intro) }}</textarea>
						</div>

						<div class="am-form-group">
							<label for="doc-art_content">文章内容</label>
							<textarea placeholder="请填写文章内容" rows="3" rows="5" id="doc-art_content" name="art_content">{{ old('art_content', $article->art_content) }}</textarea>
						</div>

						<div class="am-form-group">
							<label for="doc-select-1">文章状态</label>
							<select id="doc-select-1" name="art_status">
								<option value="1" @if(old('art_status', $article->art_status) == 1) selected @endif>黑名单</option>
								<option value="2" @if(old('art_status', $article->art_status) == 2) selected @endif>待审核</option>
								<option value="3" @if(old('art_status', $article->art_status) == 3) selected @endif>已审核</option>
							</select>
							<span class="am-form-caret"></span>
						</div>

						<div class="am-form-group">
							<label class="am-checkbox-inline">
								<input type="checkbox" name="art_ispay" value="1" @if(old('art_ispay', $article->art_ispay) ==1) checked="checked" @endif> 是否支付
							</label>
							<label class="am-checkbox-inline">
								<input type="checkbox" name="art_istop" value="1" @if(old('art_istop', $article->art_istop) == 1) checked="checked" @endif> 是否置顶
							</label>
							<label class="am-checkbox-inline">
								<input type="checkbox" name="art_isbest" value="1" @if(old('art_isbest', $article->art_isbest) == 1) checked="checked" @endif> 是否推荐
							</label>
						</div>

						<p><button type="submit" class="am-btn am-btn-default">提交</button></p>
					</fieldset>
				</form>
		</div>
	</div>
@endsection
