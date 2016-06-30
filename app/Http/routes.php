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
    Route::get('/', 'IndexController@Index');
    Route::get('/ceshi', 'IndexController@ceshi');
    Route::get('/tags/{str}', 'IndexController@tags');
    Route::get('/diypage-{id}.html','IndexController@Diypage');
    //route::get('/sitemap.xml','IndexController@get_sitemap');

    Route::get('/footmark-{id}.html','FootmarkController@Info');

    Route::get('/webdir', 'WebdirController@Index');
    Route::get('/webdir/{id}','WebdirController@Lists');
    Route::get('/siteinfo-{id}.html','WebdirController@Info');

    Route::get('/article', 'ArticleController@Index');
    Route::get('/article/{id}','ArticleController@Lists');
    Route::get('/artinfo-{id}.html','ArticleController@Info');

    Route::get('/qrcode', 'QrcodeController@Index');
    Route::get('/qrcode/{id}','QrcodeController@Lists');
    Route::get('/qrcode-{id}.html','QrcodeController@Info');
});

Route::auth();

Route::group(['middleware' => ['web']], function () {
    Route::get('/oauth/{service}', 'Auth\AuthController@redirectToProvider');
    Route::get('/oauth/{service}/callback', 'Auth\AuthController@handleProviderCallback');
});

Route::group(['as' => 'home::'], function () {
  Route::get('/home', 'HomeController@Index');

  Route::get('/vendor', 'Homecontroller@Vendor');

  Route::get('/get_site', 'HomeController@Get_Site');
  Route::get('/add_site', 'HomeController@Add_Site_Get');
  Route::post('/add_site', 'HomeController@Add_Site_Post');
  Route::get('/edit_site/{id}', 'HomeController@Edit_Site_Get');
  Route::post('/edit_site', 'HomeController@Edit_Site_Post');

  Route::get('/get_art', 'HomeController@Get_Art');
  Route::get('/add_art', 'HomeController@Add_Art_Get');
  Route::post('/add_art', 'HomeController@Add_Art_Post');
  Route::get('/edit_art/{id}', 'HomeController@Edit_Art_Get');
  Route::post('/edit_art', 'HomeController@Edit_Art_Post');
});
