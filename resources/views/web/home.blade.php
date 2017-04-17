@extends('layouts.home')

@section('content')
    <div class="am-g am-g-fixed">
        <div class="am-u-md-12 am-u-end color-margin-bottom">
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
                  <p> {{ Session::get('success') }} </p>
              </div>
          @endif
        </div>
        <div class="am-u-md-12 am-u-end color-margin-bottom">
          <div class="color-card color-card-bordered color-card-color">
              <div class="color-card-head">
                  <div class="color-card-head-title am-collapsed am-text-success"> <i class="am-icon-github"></i> 密钥管理</div>
              </div>
              <div class="color-card-extra"></div>
              <div class="color-card-body">
                  <a target="_blank" title="SEO综合查询接口文档" href="http://www.webshowu.com/wiki_seo.html">SEO综合查询接口文档</a>
                  <form method="post" action="{{ url('/home') }}">
                      {{ csrf_field() }}
                      <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                      <input type="hidden" value="api_token" name="action" />

                      <div class="color-form-group color-form-line">
                          <span class="color-form-control-ico"><i class="am-icon-user"></i></span>
                          <input class="color-form-control color-form-control-ico-input-left" placeholder="api_token" type="text" name="name" value="{{ $myself->api_token }}" disabled>
                          <label class="color-form-control-label">api_token</label>
                          <span class="color-form-control-help">api_token</span>
                      </div>

                      <div class="color-form-group color-form-line">
                          <button type="submit" class="am-btn am-btn-secondary am-radius">重新申请</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <div class="am-u-md-12 am-u-end color-margin-bottom">
          <div class="color-card color-card-bordered color-card-color">
              <div class="color-card-head">
                  <div class="color-card-head-title am-collapsed am-text-success"> <i class="am-icon-github"></i> 绑定回调域名</div>
              </div>
              <div class="color-card-extra"></div>
              <div class="color-card-body">
                  <form method="post" action="{{ url('/home') }}">
                      {{ csrf_field() }}
                      <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                      <input type="hidden" value="api_url" name="action" />

                      <div class="color-form-group color-form-line">
                          <span class="color-form-control-ico"><i class="am-icon-user"></i></span>
                          <input class="color-form-control color-form-control-ico-input-left" placeholder="请填写回调域名" type="text" name="api_url" value="{{ $myself->api_url }}">
                          <label class="color-form-control-label">api_url</label>
                          <span class="color-form-control-help">例如：http://www.webshowu.com/</span>
                      </div>

                      <div class="color-form-group color-form-line">
                          <button type="submit" class="am-btn am-btn-secondary am-radius">提交</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <div class="am-u-md-12 am-u-end color-margin-bottom">
          <div class="color-card color-card-bordered color-card-color">
              <div class="color-card-head">
                  <div class="color-card-head-title am-collapsed am-text-success"> <i class="am-icon-github"></i> 个人信息</div>
              </div>
              <div class="color-card-extra"></div>
              <div class="color-card-body">
                  <div class="color-form-group">
                      <form method="post" action="{{ url('/home') }}">
                          {{ csrf_field() }}
                          <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                          <input type="hidden" value="user_info" name="action" />
                          <div class="color-form-group color-form-line">
                              <span class="color-form-control-ico"><i class="am-icon-user"></i></span>
                              <input class="color-form-control color-form-control-ico-input-left" placeholder="请输入昵 称" type="text" name="name" value="{{ $myself->name }}">
                              <label class="color-form-control-label">昵 称</label>
                              <span class="color-form-control-help">请输入昵 称</span>
                          </div>

                          <div class="color-form-group color-form-line">
                              <button type="submit" class="am-btn am-btn-secondary am-radius">提交</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
        </div>
    </div>
@endsection
