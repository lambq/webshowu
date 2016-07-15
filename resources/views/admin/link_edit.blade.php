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

				<form class="am-form" name="myfrom" id="myfrom" method="post" action="{{ url('/admin/link') }}">
					<fieldset>
						{{ csrf_field() }}
						<input type="hidden" value="{{ csrf_token() }}" name="_token" />
						<input type="hidden" value="{{ $edit_id }}" name="edit_id" />

						<div class="am-form-group">
							<label for="doc-link_name">链接名称</label>
							<input type="text" name="link_name" id="doc-link_name" placeholder="请输入链接名称" value="{{ $link->link_name }}">
						</div>

						<div class="am-form-group">
							<label for="doc-link_url">链接地址</label>
							<input type="text" name="link_url" id="doc-link_url" placeholder="请输入链接地址" value="{{$link->link_url}}">
						</div>

						<div class="am-form-group">
							<label for="doc-link_logo">链接LOGO</label>
							<input type="text" name="link_logo" id="doc-link_logo" placeholder="请输入链接LOGO" value="{{$link->link_logo}}">
						</div>

						<div class="am-form-group">
							<label for="doc-link_hide">链接状态</label>
							<input type="text" name="link_hide" id="doc-link_hide" placeholder="请输入链接状态1为开启" value="{{$link->link_hide}}">
						</div>

						<div class="am-form-group">
							<label for="doc-link_order">链接排序</label>
							<input type="text" name="link_order" id="doc-link_order" placeholder="请输入链接排序" value="{{ $link->link_order }}">
						</div>

						<p><button type="submit" class="am-btn am-btn-default">提交</button></p>
					</fieldset>
				</form>
		</div>
	</div>
@endsection
