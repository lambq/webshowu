<div class="am-u-md-4 am-u-end color-margin-bottom">
  <div class="color-card color-card-bordered color-card-color">
    <div class="color-card-head">
      <div class="color-card-head-title"> <i class="am-icon-github"></i> 最新点入 </div>
    </div>
    <div class="color-card-extra">
      <div class="tool">
        <a href="javascript:;" class="collapse active"> </a>
        <a href="javascript:;" class="config"> </a>
        <a href="javascript:;" class="reload"> </a>
        <a href="javascript:;" class="remove"> </a>
      </div>
    </div>
    <div class="color-card-body">
      <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
        <div class="am-list-news-bd">
          <ul class="am-list">
            @foreach($newsites as $v)
              <li class="am-g am-list-item-dated">
                <a title="{{ $v->web_name }}" target="_blank" href="{{ url("siteinfo-$v->web_id.html") }}" class="am-list-item-hd ">{{ $v->web_name }}</a>
                <span class="am-list-date">{{ $v->created_at->toDateString() }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="am-u-md-4 am-u-end color-margin-bottom">
  <div class="color-card color-card-bordered color-card-color">
    <div class="color-card-head">
      <div class="color-card-head-title"> <i class="am-icon-github"></i> 推荐资讯 </div>
    </div>
    <div class="color-card-extra">
      <div class="tool">
        <a href="javascript:;" class="collapse active"> </a>
        <a href="javascript:;" class="config"> </a>
        <a href="javascript:;" class="reload"> </a>
        <a href="javascript:;" class="remove"> </a>
      </div>
    </div>
    <div class="color-card-body">
      <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
        <div class="am-list-news-bd">
          <ul class="am-list">
            @foreach ($art_list as $v)
              <li class="am-g am-list-item-dated">
                <a title="{{ $v->art_title }}" target="_blank" href="{{ url('/artinfo-'.$v->art_id.'.html') }}" class="am-list-item-hd ">
                  {{ $v->art_title }}
                </a>
                <span class="am-list-date">{{ $v->updated_at->toDateString() }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
