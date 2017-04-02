@extends('layouts.admin')

@section('content')
	<div class="admin-content-body">
		<div class="am-cf am-padding am-padding-bottom-0">
			<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $site_nav }}</strong></div>
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
								<th class="table-date am-hide-sm-only">提交时间</th>
								<th class="table-set">操作</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pages as $v)
							<tr>
								<td>{{ $v->page_id}}</td>
								<td>{{ $v->page_name }}</td>
								<td class="am-hide-sm-only">{{ $v->created_at}}</td>
								<td>
									<div class="am-btn-toolbar">
										<div class="am-btn-group am-btn-group-xs">
											<a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ url('pages/'.$v->page_id) }}" >
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
							{!! $pages->links() !!}
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection