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

    <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
      <!--列表标题-->
      <div class="am-list-news-hd am-cf">
        <!--带更多链接-->
        <a href="{{ url('/webdir') }}" class="">
          <h2>推荐站点</h2>
          <span class="am-list-news-more am-fr">更多 &raquo;</span>
        </a>
      </div>

      <div class="am-list-news-bd">
        <ul class="am-list">
          <!--缩略图在标题左边-->
          @foreach ($site_list as $str)
          <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
            <div class="am-u-sm-4 am-list-thumb">
              <a href="{{ url('/siteinfo-'.$str->web_id.'.html') }}" class="">
                <img class="lazy" data-original="http://api.webthumbnail.org/?width=480&height=330&screen=1280&url={{ $str->web_url }}" src="{{ url('images/lazy_loading.jpg') }}" alt="{{ $str->web_name }}"/>
              </a>
            </div>

            <div class=" am-u-sm-8 am-list-main">
              <h3 class="am-list-item-hd"><a href="{{ url('/siteinfo-'.$str->web_id.'.html') }}" class="">{{ $str->web_name }}</a></h3>
              <div class="am-list-item-text">{{ $str->intro }}</div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>

    <script>document.write(unescape('%3Cdiv id="hm_t_94821"%3E%3C/div%3E%3Cscript charset="utf-8" src="http://crs.baidu.com/t.js?siteId=73d6f22b97da2e1d37ee429edbecaf61&planId=94821&async=0&referer=') + encodeURIComponent(document.referrer) + '&title=' + encodeURIComponent(document.title) + '&rnd=' + (+new Date) + unescape('"%3E%3C/script%3E'));</script>
  </div>