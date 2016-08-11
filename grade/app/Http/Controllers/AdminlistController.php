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
class AdminlistController extends BaseController
{
    //管理员列表
    public function index(){
        $users = DB::table('user')->where("u_identity",'>','1')->select("*")->paginate(6);
        return view("adminlist.user_list",['adminlist'=>$users]);
    }
    //新增管理员
    public  function add_admin(){
        $role =  DB::table('role')->select("*")->get();
        return view('adminlist.strator',['role'=>$role]);
    }
    //管理员添加入库
    public function insert_admin(Request $request)
    {
            $name = $request->input('u_name');
            $pwd = md5($request->input('u_pwd'));
            $qrpwd = md5($request->input('afm_pwd'));
            $role = $request->input('role');
            $addtime = time();
            if($pwd == $qrpwd){
                $data =  DB::table('user')->insert(['u_name' =>"$name" ,'u_pwd' =>"$pwd" , 'u_addtime' =>  "$addtime",'u_action_list'=>"$role"]);
                if($data){
                    return redirect('admin_list');
                }else{
                    echo '添加失败请联系管理员';
                }
            }else{
                echo '俩次密码不一致';
            }
    }
    //删除管理员
    public function dell_admin(Request $request)
    {
        $id = $request->input('id');
        $del = DB::table('user')->where('u_id', '=', $id)->delete();
        if($del){
            echo 1;exit();
        }else{
            echo 2;exit();
        }
    }

    //根据姓名查询管理员
    public function findadmin(Request $request){
        $u_name=$request->input('name');
        $results = DB::table('user')->where('u_name', 'like', "%$u_name%")->paginate(2);
        return view('adminlist.user_list_seach', ['adminlist' => $results,'u_name'=>$u_name]);
        //var_dump($results);
        //echo json_encode($results);
    }
}