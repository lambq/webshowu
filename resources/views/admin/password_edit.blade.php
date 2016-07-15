@extends('layouts.admin')

@section('content')
<div class="admin-content-body">
	<div class="am-cf am-padding am-padding-bottom-0">
		<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $site_nav }}</strong></div>
	</div>

	<hr/>

	<div class="am-g">
		<div class="am-u-sm-12">
			<form class="am-form am-form-horizontal" name="myfrom" id="myfrom" method="post" action="{{ url('/admin/password') }}">
				{{ csrf_field() }}
				<input type="hidden" value="{{ csrf_token() }}" name="_token" />

				@if(count($errors) > 0)
					<div class="am-alert am-alert-warning" data-am-alert>
							@foreach($errors->all() as $error)
								{{ $error }} &nbsp;&nbsp;
							@endforeach
					</div>
				@endif

				@if(Session::has('success'))
					<div class="am-alert am-alert-success" data-am-alert>{{ Session::get('success') }}</div>
				@endif
				
				<!-- <div class="am-form-group">
					<label for="old_password" class="am-u-sm-3 am-form-label">旧密码</label>
					<div class="am-u-sm-9">
						<input type="password" name="old_password" id="old_password" placeholder="输入您现在使用的密码">
						<small>输入您现在使用的密码</small>
					</div>
				</div> -->

				<div class="am-form-group">
					<label for="new_password" class="am-u-sm-3 am-form-label">新密码</label>
					<div class="am-u-sm-9">
						<input type="password" name="new_password" id="new_password" placeholder="输入您新的密码">
						<small>输入您新的密码</small>
					</div>
				</div>

				<div class="am-form-group">
					<label for="confirm_password" class="am-u-sm-3 am-form-label">确认密码</label>
					<div class="am-u-sm-9">
						<input type="password" name="confirm_password" id="confirm_password" placeholder="重新再次输入新的密码">
					</div>
				</div>

				<div class="am-form-group">
					<div class="am-u-sm-9 am-u-sm-push-3">
						<button type="submit" class="am-btn am-btn-default">保存修改</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection