<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Session;
use DB;

class PasswordController extends BaseController
{
    /* 修改密码表单页面*/
    public function index(){
        return view('password.index');
    }
    /*修改密码*/
    public function update(Request $request){
        //echo 123;exit;
        $pwdss=md5($request->get('pwdss'));
        $userpwd=md5($request->get('userpwd'));

        //获取到当前登录人的ID
        $id=Session::get('u_id');
        $se = DB::table('user')->where('u_id',$id)->where('u_pwd',"$pwdss")->first();
        if(empty($se)){
            echo '2';exit();
        }
        $up = DB::table('user')->where('u_id',$id)->update(['u_pwd'=>"$userpwd"]);
        if($up){
            echo 1;exit();
        }else{
            echo 0;exit();
        }
    }

}