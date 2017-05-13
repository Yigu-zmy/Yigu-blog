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

Route::get('/', function () {
    return view('pre/index');
});

Route::get('/home', function () {
    return view('about/index');
});

Route::get('/articles','Data\DataController@getArticles');
Route::get('/article','Data\DataController@getArticle');

Route::get('/about',function (){
   return view('about/index');
});

Route::get('/edit', ['middleware' => 'auth.basic',function (){
    $categorys = \App\Model\Categorys::select('name')->get();
    return view('edit/index')->with('categorys',$categorys);
}]);

Route::get('/category','Data\DataController@getCategorys');


Route::get('/updatearticle','Data\DataController@getUserArticles');

Route::get('/upedit','Data\DataController@getUserArticleForUpdate');


Route::group(['prefix'=>'data'],function () {
    Route::post('/insertarticle','Data\DataController@insertArticles');
    Route::post('/insertcategory','Data\DataController@insertCategory');
    Route::post('/updatecategory','Data\DataController@updatecategory');
    Route::post('/upthearticle','Data\DataController@updateArticle');
    Route::post('/deletearticle','Data\DataController@deleteArticle');
});




// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// 密码重置链接的路由...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// 密码重置的路由...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');



Route::get('/test',function (){
   return view('test');
});