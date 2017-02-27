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

  <div class="am-u-sm-12 am-u-md-4 am-u-lg-4">
    <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
      <!--列表标题-->
      <div class="am-list-news-hd am-cf">
        <!--带更多链接-->
        <a href="##" class="">
          <h2>推荐资讯</h2>
        </a>
      </div>

      <div class="am-list-news-bd">
        <ul class="am-list">
          @foreach ($art_list as $str)
          <li class="am-g am-list-item-dated">
            <a title="{{ $str->art_title }}" href="{{ url('/artinfo-'.$str->art_id.'.html') }}" target="_blank" class="am-list-item-hd ">{{ $str->art_title }}</a>
            <span class="am-list-date">{{ $str->updated_at->toDateString() }}</span>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    <script>document.write(unescape('%3Cdiv id="hm_t_94821"%3E%3C/div%3E%3Cscript charset="utf-8" src="http://crs.baidu.com/t.js?siteId=73d6f22b97da2e1d37ee429edbecaf61&planId=94821&async=0&referer=') + encodeURIComponent(document.referrer) + '&title=' + encodeURIComponent(document.title) + '&rnd=' + (+new Date) + unescape('"%3E%3C/script%3E'));</script>
  </div>