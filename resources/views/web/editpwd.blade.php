@extends('layouts.home')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12">
			<form class="form-horizontal" name="myfrom" id="myfrom" method="post" action="">
				<input type="hidden" value="POST" name="_method">
				<input type="hidden" value="{{ csrf_token() }}" name="_token" />
				<input type="hidden" value="{{ $myself->user_id }}" name="edit_id" />
				@if(count($errors) > 0)
				<div class="alert alert-danger" role="alert">
					<i class="fa fa-exclamation-circle"></i> 
					<strong>
						@foreach($errors->all() as $error)
							{{ $error }} &nbsp;&nbsp;
						@endforeach
					</strong>
				</div>
				@endif
				@if(Session::has('success'))
				<div class="alert alert-success">{{ Session::get('success') }}</div>
				@endif
				<div class="form-group">
					<label class="col-sm-2 control-label" for="art_title">登录帐号：</label>
					<div class="col-sm-10"><p class="form-control-static">{{ $myself->user_email }}</p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="old_pass">原始密码：</label>
					<div class="col-sm-10">
						<input type="password" placeholder="请输入原始密码" id="old_pass" class="form-control" name="old_pass">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="new_pass">新 密 码：</label>
					<div class="col-sm-10">
						<input type="password" placeholder="请输入新 密 码" id="new_pass" class="form-control" name="new_pass">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="new_pass1">确认密码：</label>
					<div class="col-sm-10">
						<input type="password" placeholder="再次输入新 密 码" id="new_pass1" class="form-control" name="new_pass1">
					</div>
				</div>
				<div class="form-group">
					<button name="submit" id="submit_btn" class="btn btn-primary btn-block" type="submit">提 交</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
