@extends('layouts.admin')

@section('content')
	<div class="admin-content-body">
		<div class="am-cf am-padding am-padding-bottom-0">
			<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">{{ $site_nav }}</strong></div>
		</div>

		<hr>

		<div class="am-g">
			<div class="am-u-sm-12 am-scrollable-horizontal">
				<form class="am-form">
					<table class="am-table am-table-striped am-table-hover table-main am-text-nowrap">
						<thead>
							<tr>
								<th class="table-id">ID</th>
								<th class="table-type">友链名称</th>
								<th class="table-title">链接地址</th>
								<th class="table-author am-hide-sm-only">属性状态</th>
								<th class="table-date am-hide-sm-only">链接排序</th>
								<th class="table-set">操作</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($link as $str)
							<tr>
								<td>{{ $str->link_id}}</td>
								<td><a href="{{ $str->link_url }}" target="_blank">{{ $str->link_url }}</a></td>
								<td>{{ $str->link_name }}</td>
								<td class="am-hide-sm-only">
									@if ($str->link_hide == 1)
										开启
									@else
										关闭
									@endif
								</td>
								<td class="am-hide-sm-only">{{ $str->created_at}}</td>
								<td>
									<div class="am-btn-toolbar">
										<div class="am-btn-group am-btn-group-xs">
											<a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="{{ url('/admin/link/'.$str->link_id) }}" >
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
							{!! $link->links() !!}
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection