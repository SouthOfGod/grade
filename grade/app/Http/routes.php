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

// 默认入口
Route::get('/',"LoginController@index");

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web']], function () {

    // 登陆
    Route::any('Login/index',"LoginController@index");
    //退出
    Route::any('quit',"LoginController@quit");
    //登陆后查看权限
    Route::any('Login/power',"LoginController@power");

    /*首页*/
    // 首页
    Route::any('Index/index',"IndexController@index");
    // 头部
    Route::any('Index/top',"IndexController@top");
    // 左面导航
    Route::any('Index/left',"IndexController@left");
    //Route::any('rolelist',"RolelistController@index");




    // 右面主体
    Route::any('Index/right',"IndexController@right");

    /*权限*/
    // 添加管理员
    Route::any('Power/user',"PowerController@user");
    // 管理员列表
    Route::any('admin_list',"AdminlistController@index");
    //新增管理员
    Route::any('admin_add',"AdminlistController@add_admin");
    //管理员添加入库
    Route::any('insertadmin',"AdminlistController@insert_admin");
    //删除管理员
    Route::any('delladmin',"AdminlistController@dell_admin");
	 //查找管理员
    Route::any('findadmin',"AdminlistController@findadmin");
    //管理员导入
    Route::any('Administr_list',"AdministrController@index");
    Route::any('Administr/add',"AdministrController@add");

    // 添加角色表单列表
    Route::any('admin_add_role',"RolelistController@roleform");
    // 角色列表
    Route::any('admin_list_role',"RolelistController@index");
    // 角色入库
    Route::any('addrole',"RolelistController@addrole");
    //删除角色
    Route::any('dellrole',"RolelistController@dellrole");
    //搜索角色
    Route::any('findrole',"RolelistController@findrole");

    // 录入成绩
        Route::any('add_grade',"MarkController@index");
    // 添加入库
        Route::any('Mark/add',"MarkController@add");
    // 成绩状态修改
        Route::any('check',"MarkController@check");
    // 查看成绩
        Route::any('grade_list',"MarkController@see_mark");
    // 审核成绩
        Route::any('check_grade',"MarkController@check_mark");
    // 下拉列表查询
        Route::any('search',"MarkController@search");
    // 成材率统计
        Route::any('yield_list',"MarkController@analyse");


	/*小组*/
	// 分配小组
	Route::any('allot_group',"GroupController@index");
	// 小组添加
	Route::any('Group/groupAdd',"GroupController@groupAdd");
	// 查看小组
	Route::any('group_list',"GroupController@checkGroup");
	Route::controller('/Group',"GroupController");
    Route::any('groupnum',"GroupController@Groupnum");
    Route::any('groupAdd',"GroupController@groupAdd");
    Route::any('hasleader',"GroupController@Hasleader");
    Route::any('groupdel',"GroupController@Groupdel");
    

    // 班级pk
    Route::any('allot_pk_grade',"ClasssController@index");
    // 获取平行班
    Route::any('Classs/getstage',"ClasssController@getstage");
    // PK组添加
    Route::any('Classs/pkadd',"ClasssController@pkadd");
    // 查看PK组
    Route::any('pk_grade_list',"ClasssController@show");


    /*  学院班级管理*/
	  //班级管理表单页面
    Route::any('Ban/index',"BanController@index");
    // 班级添加
    Route::any('add_class',"BanController@add_class");
    //班级列表
    Route::any('class_list',"BanController@class_list");
    //查找班级
    Route::any('findban',"BanController@findban");



     /*教学周期*/
    //教学周期列表
     //Route::any('cycle_list',"");
     Route::any('up_cycle',"CycleController@index");
    //教学周期添加
     Route::any('Cycle/add',"CycleController@add");
    //分配日期
     Route::any('Cycle/date_list',"CycleController@date_list");
    //考试类型添加
     Route::any('Cycle/insert',"CycleController@insert");
    //周期列表
     Route::any('cycle_list',"CycleController@show_list");
     Route::any('Cycle/ex_list',"CycleController@ex_list");

    /*密码*/
    // 修改密码表单页
    Route::any('Password/index',"PasswordController@index");
    //修改密码
    Route::any('Password/update',"PasswordController@update");
	//导出
    Route::any('export','ExcelController@export');
	//导入
    Route::any('import','ExcelController@import');

});