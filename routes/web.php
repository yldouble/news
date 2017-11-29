<?php
/*Route::any('main','PublicController@index');
Route::any('searchorder','OrderController@index');
Route::post('searchorderdata','OrderController@search');
Route::get('product/{id}','ProductController@index')->where('id', '[0-9]+');
Route::post('productimglist','ProductController@PhotoList');
Route::post('deleteimg','ProductController@DeleteImg');
Route::post('upload','ProductController@Upload');
*/

Route::get('/', 'Home\IndexController@index');

//前台路由组
Route::group(['namespace' => 'Home'], function () {
    // 控制器在 "App\Http\Controllers\Home" 命名空间下
    Route::get('/', [
        'as' => 'index', 'uses' => 'IndexController@index'
    ]);

});

//后台路由组
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

//    Route::get('/', [
//        'as' => 'index', 'uses' => 'LoginController@index'
//    ]);
    Route::get('/', 'LoginController@index');
    Route::post('login', 'LoginController@login');
    Route::get('login', 'LoginController@index');
    Route::any('signout', 'LoginController@signout');
    Route::resource('main', 'PublicController');
    //任务管理
    Route::resource('task', 'TaskController');
    Route::post('tlist', 'TaskController@TaskList');
    Route::get('tlist', 'TaskController@TaskList');
    Route::get('tadd', 'TaskController@add');
    Route::get('tdetail/{tid?}', 'TaskController@detail')->where("tid", '[0-9]+');

    Route::post('post_task', 'TaskController@post_task');
    Route::get('tversion', 'TaskController@task_version');

});


?>