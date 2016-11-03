<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//目录网站
Route::group(['as' => 'front::'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/tags/{str}', 'IndexController@tags');
    Route::get('/diypage-{id}.html','IndexController@diypage');

    Route::get('/footmark-{id}.html','FootmarkController@info');

    Route::get('/webdir', 'WebdirController@index');
    Route::get('/webdir/{id}','WebdirController@lists');
    Route::get('/siteinfo-{id}.html','WebdirController@info');

    Route::get('/article', 'ArticleController@index');
    Route::get('/article/{id}','ArticleController@lists');
    Route::get('/artinfo-{id}.html','ArticleController@info');

    Route::get('/qrcode', 'QrcodeController@index');
    Route::get('/qrcode/{id}','QrcodeController@lists');
    Route::get('/qrcode-{id}.html','QrcodeController@info');
		
    //自带oauth登陆机制
    Route::get('/oauth/{service}', 'Auth\AuthController@redirectToProvider');
    Route::get('/oauth/{service}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('/ceshi', 'CeshiController@index');
});

Route::group(['as' => 'admin::'], function () {
    //自带登陆机制——扩展admin
    Route::get('admin/login', 'Admin\AuthController@showLoginForm');
    Route::post('admin/login', 'Admin\AuthController@login');
    Route::get('admin/logout', 'Admin\AuthController@logout');

    Route::get('admin', 'AdminController@index');

    Route::get('admin/webdir', 'AdminController@webdir_index');
    Route::get('admin/webdir/{id}', 'AdminController@webdir_edit');
    Route::post('admin/webdir', 'AdminController@webdir_update');

    Route::get('admin/setting','AdminController@setting_edit');
    Route::post('admin/setting','AdminController@setting_update');

    Route::get('admin/password','AdminController@password_edit');
    Route::post('admin/password','AdminController@password_update');

    Route::get('admin/link','AdminController@link_index');
    Route::get('admin/link/{id}','AdminController@link_edit');
    Route::post('admin/link','AdminController@link_update');

    Route::get('admin/menu','AdminController@menu_index');
});

Route::group(['as' => 'home::'], function () {
    //自带登陆机制
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/vendor', 'Homecontroller@vendor');

    Route::get('/get_site', 'HomeController@get_site');
    Route::get('/add_site', 'HomeController@add_site_get');
    Route::post('/add_site', 'HomeController@add_site_post');
    Route::get('/edit_site/{id}', 'HomeController@edit_site_get');
    Route::post('/edit_site', 'HomeController@edit_site_post');

    Route::get('/get_art', 'HomeController@get_art');
    Route::get('/add_art', 'HomeController@add_art_get');
    Route::post('/add_art', 'HomeController@add_art_post');
    Route::get('/edit_art/{id}', 'HomeController@edit_art_get');
    Route::post('/edit_art', 'HomeController@edit_art_post');
});