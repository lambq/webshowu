@extends('layouts.admin')

@section('content')
<div class="admin-content-body">
	<div class="am-cf am-padding am-padding-bottom-0">
		<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $site_nav }}</strong></div>
	</div>

	<hr/>

	<div class="am-g">
		<div class="am-u-sm-12">
			<form class="am-form am-form-horizontal">
				<div class="am-form-group">
					<label for="user-QQ" class="am-u-sm-3 am-form-label">QQ</label>
					<div class="am-u-sm-9">
						<input type="number" pattern="[0-9]*" id="user-QQ" placeholder="输入你的QQ号码">
					</div>
				</div>

				<div class="am-form-group">
					<label for="user-weibo" class="am-u-sm-3 am-form-label">微博 / Twitter</label>
					<div class="am-u-sm-9">
						<input type="text" id="user-weibo" placeholder="输入你的微博 / Twitter">
					</div>
				</div>

				<div class="am-form-group">
					<label for="user-intro" class="am-u-sm-3 am-form-label">简介 / Intro</label>
					<div class="am-u-sm-9">
						<textarea class="" rows="5" id="user-intro" placeholder="输入个人简介"></textarea>
						<small>250字以内写出你的一生...</small>
					</div>
				</div>

				<div class="am-form-group">
					<div class="am-u-sm-9 am-u-sm-push-3">
						<button type="button" class="am-btn am-btn-primary">保存修改</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection