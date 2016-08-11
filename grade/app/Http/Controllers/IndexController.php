<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Session;
use Illuminate\Http\Request;
header("content-type:text/html; charset=utf-8");
class IndexController extends BaseController
{
    /* 首页 */
    public function index(){
        return view('index.index');
    }

    /* 左侧导航 */
    public function left(Request $request){
        //var_dump($request);exit;
        include_once(__DIR__."/../../../includes/inc_menu.php");

        // 权限对照表
        include_once(__DIR__.'/../../../includes/inc_priv.php');

        include_once(__DIR__."/../../../languages/common.php");
        //var_dump($modules);exit;
        //循环二级菜单
        foreach ($modules AS $key => $value)
        {
            // 对数组按照键名排序
            ksort($modules[$key]);
        }
        // 对数组按照键名排序
        ksort($modules);
        //var_dump($modules);exit;
        foreach ($modules AS $key => $val)
        {
            //确定一级菜单的名称
            $menus[$key]['label'] = $_LANG[$key];
            //判断是否为数组  如果数组有数据继续执行下列操作
            if (is_array($val))
            {
                //循环inc_menu的第二级
                foreach ($val AS $k => $v)
                {
                    //判断第二级为真的话执行if
                    if ( isset($purview[$k]))
                    {
                        // var_dump($purview[$k]);exit;
                        if (is_array($purview[$k]))
                        {
                            $boole = false;
                            foreach ($purview[$k] as $action)
                            {
                                $boole = $boole || admin_priv($action, '', false);
                            }
                            if (!$boole)
                            {
                                continue;
                            }

                        }
                        else
                        {
                            if (! $this->admin_priv($purview[$k], '', false,$request))
                            {
                                continue;
                            }
                        }
                    }
//                  if ($k == 'ucenter_setup' && $_CFG['integrate_code'] != 'ucenter')
//                  {
//                      continue;
//                  }
                    $menus[$key]['children'][$k]['label']  = $_LANG[$k];
                    $menus[$key]['children'][$k]['action'] = $v;
                }
            }
            else
            {
                $menus[$key]['action'] = $val;
            }
            //var_dump($menus);exit;
            // 如果children的子元素长度为0则删除该组
            if(empty($menus[$key]['children']))
            {
                unset($menus[$key]);
            }
        }
        return view('index.left',['action_list'=>$menus]);
    }

    /* 头部 */
    public function top(){
        return view('index.top');
    }

    /* 右侧主体 */
    public function right(){
        return view('index.right');
    }

    function admin_priv($priv_str, $msg_type = '' , $msg_output = true,$request)
    {
        global $_LANG;
        $list=$request->session()->get('action_list');
        //echo $list;exit;
        //$a = 'admin_list,admin_role,admin_add_role,admin_edit_role,admin_list_role';
        if ($list == 'all')
        {
            return true;
        }
        if (strpos(',' . $list . ',', ',' . $priv_str . ',') === false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

}