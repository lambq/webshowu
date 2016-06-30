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
					<label class="col-sm-2 control-label" for="nick_name">昵 称：</label>
					<div class="col-sm-10">
						<input type="text" value="{{ $myself->nick_name }}" placeholder="请输入昵 称" id="nick_name" class="form-control" name="nick_name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="user_qq">QQ号码：</label>
					<div class="col-sm-10">
						<input type="text" value="{{ $myself->user_qq }}" placeholder="请输入QQ号码" id="user_qq" class="form-control" name="user_qq">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="art_title">注册时间：</label>
					<div class="col-sm-10"><p class="form-control-static">{{ $myself->created_at }}</p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="art_title">最后登录时间：</label>
					<div class="col-sm-10"><p class="form-control-static">{{ $myself->updated_at }}</p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="art_title">最后登录IP：</label>
					<div class="col-sm-10"><p class="form-control-static">{{ $myself->login_ip }}</p></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="art_title">登录次数：</label>
					<div class="col-sm-10"><p class="form-control-static">{{ $myself->login_count }}次</p></div>
				</div>
				<div class="form-group">
					<button name="submit" id="submit_btn" class="btn btn-primary btn-block" type="submit">提 交</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
