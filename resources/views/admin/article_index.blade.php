@extends('layouts.admin')

@section('content')
	<div class="admin-content-body">
		<div class="am-cf am-padding am-padding-bottom-0">
			<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $site_nav }}</strong></div>
		</div>

		<hr>

		<div class="am-g am-margin-top">
			<div class="am-u-sm-12">
				<a href="{{ url('article/0') }}" class="am-btn @if($tag == 0) am-btn-success @else am-btn-default @endif am-radius">全部</a>
				<a href="{{ url('article/1') }}" class="am-btn @if($tag == 1) am-btn-success @else am-btn-default @endif am-radius">未审核</a>
				<a href="{{ url('article/2') }}" class="am-btn @if($tag == 2) am-btn-success @else am-btn-default @endif am-radius">已审核</a>
				<a href="{{ url('article/3') }}" class="am-btn @if($tag == 3) am-btn-success @else am-btn-default @endif am-radius">未支付</a>
				<a href="{{ url('article/4') }}" class="am-btn @if($tag == 4) am-btn-success @else am-btn-default @endif am-radius">已支付</a>
				<a href="{{ url('article/5') }}" class="am-btn @if($tag == 5) am-btn-success @else am-btn-default @endif am-radius">已推荐</a>
				<a href="{{ url('article/6') }}" class="am-btn @if($tag == 6) am-btn-success @else am-btn-default @endif am-radius">未置顶</a>
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
								<th class="table-title">文章标题</th>
								<th class="table-author am-hide-sm-only">属性状态</th>
								<th class="table-date am-hide-sm-only">提交时间</th>
								<th class="table-set">操作</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($article as $v)
							<tr>
								<td>{{ $v->art_id}}</td>
								<td>{{ $v->art_title }}</td>
								<td class="am-hide-sm-only">
									@if ($v->art_status == 1) 黑名单 @endif
									@if ($v->art_status == 2) 待审核 @endif
									@if ($v->art_status == 3) 已审核 @endif
								</td>
								<td class="am-hide-sm-only">{{ $v->created_at}}</td>
								<td>
									<div class="am-btn-toolbar">
										<div class="am-btn-group am-btn-group-xs">
											<a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ url('article/edit/'.$v->art_id) }}" >
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
							{!! $article->links() !!}
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection