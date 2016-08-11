<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Illuminate\Http\Request;


class PowerController extends BaseController
{
    /* 新增管理员 */
    public function user(){
        return view('power.user');
    }

    /* 管理员列表 */
    public function user_list(){
        return view('power.user_list');
    }

    /* 新增角色 */
    public function role(){
        include_once(__DIR__ . '/../../../languages/priv_action.php');
        $priv_str = '';

        /* 获取权限的分组数据 */
        $action_1 = DB::table('rms_action')->where("parent_id",'=','0')->select("*")->get();
        $array_action_1 = $this->objarray_to_array($action_1);
        foreach($array_action_1 as $k=>$v)
        {
            $v['au_name']=$_LANG[$v['action_code']];
            $priv_arr[$v['a_id']] = $v;
        }

        /* 按权限组查询底级的权限名称 */
        $datain = array_keys($priv_arr);
        $action_2 = DB::table('rms_action')->whereIn("parent_id",$datain)->select("*")->get();
        $array_action_2 = $this->objarray_to_array($action_2);
        foreach($array_action_2 as $k=>$v)
        {
            $v['au_name']=$_LANG[$v['action_code']];
            $priv_arr[$v["parent_id"]]["priv"][$v["action_code"]] = $v;
        }
        // 将同一组的权限使用 "," 连接起来，供JS全选
        foreach ($priv_arr AS $action_id => $action_group)
        {
            $priv_arr[$action_id]['priv_list'] = join(',', @array_keys($action_group['priv']));

            foreach ($action_group['priv'] AS $key => $val)
            {
                $priv_arr[$action_id]['priv'][$key]['cando'] = (strpos($priv_str, $val['action_code']) !== false || $priv_str == 'all') ? 1 : 0;
            }
        }
        return view('power.role',['priv_arr'=>$priv_arr]);
    }

    /* 角色列表 */
    public function role_list(){
        return view('power.role_list');
    }

    /* 新增权限 */
    public function power(){
        return view('power.power');
    }

    /* 分配权限 */
    public function fp_power(){
        return view('power.fp_power');
    }

    function db_create_in($item_list, $field_name = '')
    {

        if (empty($item_list))
        {
            return $field_name . " [''] ";
        }
        else
        {
            if (!is_array($item_list))
            {
                $item_list = explode(',', $item_list);
            }
            $item_list = array_unique($item_list);
            $item_list_tmp = array();
            foreach ($item_list AS $item)
            {
                if ($item !== '')
                {
                    $item_list_tmp[] = $item_list_tmp;
                }
            }
            if (!is_array($item_list_tmp))
            {
                return $field_name . "[''] ";
            }
            else
            {
                return $item_list_tmp;
            }
        }
    }
    function objarray_to_array($obj) {
        $ret = array();
        foreach ($obj as $key => $value) {
            if (gettype($value) == "array" || gettype($value) == "object"){
                $ret[$key] =  $this->objarray_to_array($value);
            }else{
                $ret[$key] = $value;
            }
        }
        return $ret;
    }
    //新增角色权限
    public  function addpower(Request $request){
        $r_name=$request->input('r_name');
        $r_desc=$request->input('r_desc');
        $r_power=$request->input('check_val');
       $user= DB::table('rms_role')->insert(['role_name' =>"$r_name" ,'action_list' =>"$r_power" , 'role_describe' =>  "$r_desc"]);
        if($user){
            echo 1;exit();
        }else{
            echo 2;exit();
        }
    }
    //新增管理员
    public  function add_admin(){
        $role =  DB::table('rms_role')->select("*")->get();
        return view('adminlist.strator',['role'=>$role]);
    }

}