<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;
use Session;


header('content-type:text/html;charset=utf-8');
class LoginController extends BaseController
{
    /* 登陆 */
    public function index(){
        return view('login.index');
    }
    //验证登陆，登陆后查权限
    public  function power(Request $request){
        //echo 123;exit;
        //验证登陆
        $name=$request->input('username');
        $pwd=md5($request->input('textfield2'));
        $users = DB::table('user')->where('u_student_number','=',$name)->first();
        //验证账号
        if(empty($users)){
           echo "<script>alert('用户名不存在');location.href='index'</script>";
        }else{
            //验证密码
            if($users->u_pwd==$pwd){
                $request->session()->put('action_list', $users->u_action_list);
                $request->session()->put('u_id', $users->u_id);
                $request->session()->put('u_name', $users->u_name);
                $request->session()->put('cla_id', $users->cla_id);
                $request->session()->put('cid', $users->c_id);
                return redirect('Index/index');
            }else{
                echo "<script>alert('密码错误');location.href='index'</script>";
            }
        }
    }
    //退出
    public function quit(Request $request){
        $request->session()->flush();
        return redirect('Login/index');
    }



}