@extends('layouts.admin')

@section('content')
	<div class="admin-content-body">
		<div class="am-cf am-padding am-padding-bottom-0">
			<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $site_nav }}</strong></div>
		</div>

		<hr/>

		<div class="am-g am-margin-top">
			<div class="am-u-sm-12">
				<a href="{{ url('webdir/0') }}" class="am-btn @if($tag == 0) am-btn-success @else am-btn-default @endif am-radius">全部</a>
				<a href="{{ url('webdir/1') }}" class="am-btn @if($tag == 1) am-btn-success @else am-btn-default @endif am-radius">未审核</a>
				<a href="{{ url('webdir/2') }}" class="am-btn @if($tag == 2) am-btn-success @else am-btn-default @endif am-radius">已审核</a>
				<a href="{{ url('webdir/3') }}" class="am-btn @if($tag == 3) am-btn-success @else am-btn-default @endif am-radius">未支付</a>
				<a href="{{ url('webdir/4') }}" class="am-btn @if($tag == 4) am-btn-success @else am-btn-default @endif am-radius">已支付</a>
				<a href="{{ url('webdir/5') }}" class="am-btn @if($tag == 5) am-btn-success @else am-btn-default @endif am-radius">已推荐</a>
				<a href="{{ url('webdir/6') }}" class="am-btn @if($tag == 6) am-btn-success @else am-btn-default @endif am-radius">未置顶</a>
			</div>
		</div>
        <hr/>
		<div class="am-g am-margin-top">
			<div class="am-u-sm-12">
				<form class="am-form-inline" role="form" method="get">
					<div class="am-form-group">
                        网站地址：<input type="text" name="web_url" class="am-form-field" id="web_url" placeholder="请输入完整手机号码进行搜索" @if($web_url) value= "{{ $web_url }}" @endif>
					</div>
					<div class="am-form-group">
						<input type="submit" name="submit" class="am-btn am-btn-success" value="搜索" onclick="search()">
					</div>
				</form>
			</div>
		</div>

		<hr/>

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
			<div class="am-u-sm-12 am-scrollable-horizontal">
				<form class="am-form">
					<table class="am-table am-table-striped am-table-hover table-main am-text-nowrap">
						<thead>
							<tr>
								<th class="table-id">ID</th>
								<th class="table-type">网站地址</th>
								<th class="table-title">网站名称</th>
								<th class="table-author am-hide-sm-only">属性状态</th>
								<th class="table-date am-hide-sm-only">提交时间</th>
								<th class="table-set">操作</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($websites as $str)
							<tr>
								<td>{{ $str->web_id}}</td>
								<td><a href="http://{{ $str->web_url }}" target="_blank">{{ $str->web_url }}</a></td>
								<td>{{ $str->web_name }}</td>
								<td class="am-hide-sm-only">
									@if ($str->web_status == 1) 黑名单 @endif 
									@if ($str->web_status == 2) 待审核 @endif 
									@if ($str->web_status == 3) 已审核 @endif
								</td>
								<td class="am-hide-sm-only">{{ $str->created_at}}</td>
								<td>
									<div class="am-btn-toolbar">
										<div class="am-btn-group am-btn-group-xs">
											<a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ url('webdir/edit/'.$str->web_id) }}" >
												<span class="am-icon-pencil-square-o"></span> 编辑
											</a>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="am-cf">
						<div class="am-fr">
							{!! $websites->links() !!}
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection