<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/**
 * middleware = web 不需要验证授权的路由
 * middleware = admin 需要验证授权的路由
 */
Route::get('/',function(){
    return redirect('admin');
});

Route::group(['namespace' => 'Login','middleware' => ['web']],function (){
    Route::get('test','TestController@index');//test页面
    
    Route::get('admin/login','HomeController@index');//登录界面
    Route::post('admin/login/submit','HomeController@login');//表单提交登录
    Route::get('admin/logoff','HomeController@logoff');//注销登录
    Route::post('admin/login/ajax','AdminAjaxController@login');//ajax提交登录验证
    Route::post('admin/update/password/ajax','AdminAjaxController@updatePassword');//修改密码页面
    Route::post('admin/update/password/form','HomeController@updatePasswordForm');//修改密码表单提交
    
    Route::any('admin/list/ajax','AdminAjaxController@adminList');//管理员列表
    Route::any('admin/valid/adminname','AdminAjaxController@validAdminName');//验证管理员账号
    Route::post('admin/delete','AdminAjaxController@actionAdmin');//操作用户  开启或关闭
    Route::post('admin/create/save','AdminController@createSave');//添加管理员表单提交
    Route::post('admin/edit/save/{id}','AdminController@editSave');//修改管理员表单提交
    
    Route::any('admin/limit/valid/limiturl','AdminLimitAjaxController@validAdminLimitUrl');//验证管理员权限url
    Route::any('admin/limit/list/ajax','AdminLimitAjaxController@dataList');//管理员权限列表
    Route::post('admin/limit/delete','AdminLimitAjaxController@deleteAdminLimit');//删除
    Route::post('admin/limit/create/save','AdminLimitController@createSave');//添加管理员权限表单提交
    Route::post('admin/limit/edit/save/{id}','AdminLimitController@editSave');//修改管理员权限表单提交
    
    Route::any('admin/role/valid/rolename','AdminRoleAjaxController@validAdminRoleName');//验证管理员角色名
    Route::any('admin/role/list/ajax','AdminRoleAjaxController@dataList');//管理员角色列表
    Route::post('admin/role/delete','AdminRoleAjaxController@deleteAdminRole');//删除
    Route::post('admin/role/create/save','AdminRoleController@createSave');//添加管理员角色表单提交
    Route::post('admin/role/edit/save/{id}','AdminRoleController@editSave');//修改管理员角色表单提交
    
});

Route::group(['namespace' => 'Login','middleware' => ['admin']],function (){
    Route::get('admin/update/password','HomeController@updatePassword');//修改密码页面
    
    Route::any('admin/list','AdminController@index');//管理员列表
    Route::any('admin/create','AdminController@create');//添加管理员页面
    Route::any('admin/edit/{id}','AdminController@edit');//修改管理员页面
    Route::any('admin/view/{id}','AdminController@view');//查看管理员页面
    
    Route::any('admin/limit/list','AdminLimitController@index');//管理员权限列表
    Route::any('admin/limit/create','AdminLimitController@create');//添加管理员权限页面
    Route::any('admin/limit/edit/{id}','AdminLimitController@edit');//修改管理员权限页面
    Route::any('admin/limit/view/{id}','AdminLimitController@view');//查看管理员权限页面
    
    Route::any('admin/role/list','AdminRoleController@index');//管理员角色列表
    Route::any('admin/role/create','AdminRoleController@create');//添加管理员角色页面
    Route::any('admin/role/edit/{id}','AdminRoleController@edit');//修改管理员角色页面
    Route::any('admin/role/view/{id}','AdminRoleController@view');//查看管理员角色页面
});

Route::group(['namespace' => 'Admin','middleware' => ['web']],function(){
    
});
Route::group(['namespace' => 'Admin','middleware' => ['admin']],function(){
    Route::any('admin','HomeController@index');//首页
});