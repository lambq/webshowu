<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//seo
Route::group(['domain' => env('APP_SEO'), 'namespace' => 'Web'],function ($router){
    $router->get('/', 'SeoController@seo_index');
    $router->post('/', 'SeoController@seo_update');
    $router->get('/{site?}', 'SeoController@seo_site');
});
//前台
Route::group(['domain' => env('APP_URL')],function (){
    Auth::routes();
    //自带oauth登陆机制
    Route::group(['prefix' => 'oauth','namespace' => 'Oauth'],function ($router){
        $router->get('github', 'GithubController@redirectToProvider');
        $router->get('github/callback', 'GithubController@handleProviderCallback');
    });
    //前端的所有路由
    Route::group(['namespace' => 'Web','as' => 'Web'],function($router){
        $router->get('/', 'IndexController@index');
        $router->get('/tags/{str}', 'IndexController@tags');
        $router->get('/diypage-{id}.html','IndexController@diypage');

        $router->get('/footmark-{id}.html','FootmarkController@info');

        $router->get('/webdir', 'WebdirController@index');
        $router->get('/webdir/{id}','WebdirController@lists');
        $router->get('/siteinfo-{id}.html','WebdirController@info');

        $router->get('/article', 'ArticleController@index');
        $router->get('/article/{id}','ArticleController@lists');
        $router->get('/artinfo-{id}.html','ArticleController@info');

        $router->get('/home', 'HomeController@home');
        $router->post('/home', 'HomeController@home');

        $router->get('/vendor', 'Homecontroller@vendor');

        $router->get('/get_site', 'HomeController@get_site');
        $router->get('/add_site', 'HomeController@add_site_get');
        $router->post('/add_site', 'HomeController@add_site_post');
        $router->get('/edit_site/{id}', 'HomeController@edit_site_get');
        $router->post('/edit_site', 'HomeController@edit_site_post');

        $router->get('/get_art', 'HomeController@get_art');
        $router->get('/add_art', 'HomeController@add_art_get');
        $router->post('/add_art', 'HomeController@add_art_post');
        $router->get('/edit_art/{id}', 'HomeController@edit_art_get');
        $router->post('/edit_art', 'HomeController@edit_art_post');

        $router->get('/seo', 'SeoController@seo_index');
        $router->post('/seo', 'SeoController@seo_update');
        $router->get('/seo/{site?}', 'SeoController@seo_site');
    });
    //站点sitemap地图
    Route::get('sitemap', function(){

        // create new sitemap object
        $sitemap = App::make("sitemap");

        // add items to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), '2017-03-19T20:10:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('/webdir'), '2017-03-19T20:10:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('/article'), '2017-03-19T20:10:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('/seo'), '2017-03-19T20:10:00+02:00', '1.0', 'daily');
        // get all menus from db

        $categories     = DB::table('categories')->orderBy('created_at', 'desc')->get();
        foreach ($categories as $v)
        {
            $sitemap->add(URL::to('/')."/$v->cate_mod/$v->cate_id", $v->updated_at, '1.0', 'daily');
        }

        $websites   = DB::table('websites')->select('web_id','web_url','updated_at')->orderBy('created_at', 'desc')->get();
        foreach ($websites as $v){
            $sitemap->add(URL::to('/')."/siteinfo-$v->web_id.html", $v->updated_at, '0.9', 'daily');
            $sitemap->add(URL::to('/')."/seo/$v->web_url", $v->updated_at, '0.9', 'daily');
        }

        $articles   = DB::table('articles')
            ->select('art_id','created_at','updated_at')
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($articles as $v){
            $sitemap->add(URL::to('/')."/artinfo-$v->art_id.html", $v->updated_at, '0.9', 'weekly');
        }
        // generate your sitemap (format, filename)
        $sitemap->store('xml', 'sitemap');
        // this will generate file mysitemap.xml to your public folder
    });
    //项目测试工程
    Route::group(['namespace' => 'Ceshi','as' => 'Web'],function($router){
        $router->get('/ceshi/makedown', 'MakedownController@index');
        $router->get('/ceshi/markdownsql', 'MakedownController@sql');
        $router->get('/ceshi', 'CeshiController@index');
        $router->get('/ceshi/seo', 'CeshiController@seo_index');
        $router->post('/ceshi/seo', 'CeshiController@seo_update');
        $router->get('/ceshi/seo/{site?}', 'CeshiController@seo_site');
    });
});
//后台
Route::group(['domain' => env('APP_ADMIN'), 'namespace' => 'Admin', 'as' => 'Admin'],function ($router){
    //自带登陆机制——扩展admin
    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout');

    $router->get('/', 'AdminController@index');

    $router->get('pages', 'AdminController@pages_index');
    $router->get('pages/{id}', 'AdminController@pages_edit');
    $router->post('pages', 'AdminController@pages_update');

    $router->get('webdir/{tag}', 'AdminController@webdir_index');
    $router->get('webdir/edit/{id}', 'AdminController@webdir_edit');
    $router->post('webdir', 'AdminController@webdir_update');

    $router->get('article/{tag}', 'AdminController@article_index');
    $router->get('article/edit/{id}', 'AdminController@article_edit');
    $router->post('article', 'AdminController@article_update');

    $router->get('setting','AdminController@setting_edit');
    $router->post('setting','AdminController@setting_update');

    $router->get('password','AdminController@password_edit');
    $router->post('password','AdminController@password_update');

    $router->get('link','AdminController@link_index');
    $router->get('link/{id}','AdminController@link_edit');
    $router->post('link','AdminController@link_update');

    $router->get('menu','AdminController@menu_index');
});