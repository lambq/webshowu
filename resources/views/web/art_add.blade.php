@extends('layouts.home')

@section('content')
  <div class="am-cf am-padding am-padding-bottom-0">
    <div class="am-fl am-cf">
      <strong class="am-text-primary am-text-lg">添加 - 我的投稿</strong> <!-- / <small>Personal information</small> -->
    </div>
  </div>

  <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

  <div class="am-g">
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

      <form class="am-form" name="myfrom" id="myfrom" method="post" action="">
        <fieldset>
          {{ csrf_field() }}
          <input type="hidden" value="{{ csrf_token() }}" name="_token" />

          <div class="am-form-group">
            <label for="doc-select-1">选择分类</label>
            <select id="doc-select-1" name="cate_id">
              {!! $category_option !!}
            </select>
            <span class="am-form-caret"></span>
          </div>

          <div class="am-form-group">
            <label for="doc-art_title">文章标题</label>
            <input type="text" name="art_title" id="doc-art_title" placeholder="请输入文章标题">
          </div>

          <div class="am-form-group">
            <label for="doc-art_tags">TAG标签</label>
            <input type="text" name="art_tags" id="doc-art_tags" placeholder="请输入TAG标签">
          </div>

          <div class="am-form-group">
            <label for="doc-copy_from">内容来源</label>
            <input type="text" name="copy_from" id="doc-copy_from" placeholder="请输入内容来源">
          </div>

          <div class="am-form-group">
            <label for="doc-copy_url">来源地址</label>
            <input type="text" name="copy_url" id="doc-copy_url" placeholder="请输入来源地址">
          </div>

          <div class="am-form-group">
            <label for="doc-art_intro">内容摘要</label>
            <input type="text" name="art_intro" id="doc-art_intro" placeholder="请输入内容摘要">
          </div>

          <div class="am-form-group">
            <label for="doc-ta-1">文章内容</label>
            <textarea class="" rows="5" id="doc-ta-1" placeholder="请输入文章内容，本文只支持markdown语法" name="art_content"></textarea>
          </div>
          
          <p><button type="submit" class="am-btn am-btn-default">提交</button></p>
        </fieldset>
      </form>
  </div>

@endsection
