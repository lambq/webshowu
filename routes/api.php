<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['domain'=> env('APP_API'), 'middleware'=> ['api', 'auth:api'], 'prefix'=> 'v1', 'namespace' => 'Api'], function ($router) {
    $router->get('/user', function(Request $request){
        return $request->user();
    });
    $router->resource('/seo', 'SeoController');
});