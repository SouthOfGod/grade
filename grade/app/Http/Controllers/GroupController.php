<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GroupController extends BaseController
{
    /* 分配小组 */
    public function index(Request $request){
        $cla_id = $request->session()->get('cla_id');
        $users = DB::table('user')->where("is_group",'0')->where('cla_id',$cla_id)->get();
        //var_dump($users);exit;
        return view('group.index',['user'=>$users]);
    }

    /*小组添加*/
    public function groupAdd(Request $request){
        $cla_id = $request->session()->get('cla_id');
        $uid = $request->input('u_id');
        $leader_id = $request->input('leader_id');
        $u_id = explode(',',$uid);
        $g_id = $request->input('g_id');
        $count = DB::table('settable')->where('g_id',$g_id)->count();
        foreach($u_id as $k=>$v){
            DB::table('settable')->insert([
                ['g_id' => $g_id, 'u_id' => $v,'cla_id'=>$cla_id,'c_id'=>1]
            ]);
        }

        DB::table('user')
            ->whereIn('u_id',$u_id)
            ->update(['is_group'=>1]);
        DB::table('user')
            ->where('u_id',$leader_id)
            ->update(['u_position'=>1]);
        $users = DB::table('user')->where("is_group",'0')->where('cla_id',$cla_id)->get();
        return view('group.index',['user'=>$users]);
    }
    /*获取小组人数*/
    public function Groupnum(Request $request){
        $g_id = $request->input('g_id');
        $count = DB::table('settable')->where('g_id',$g_id)->count();
        $counts = 6-$count;
        echo $counts;
    }
    /*查看小组*/
    public function checkGroup(){
        $info1 = $this->info(1);
        $info2 = $this->info(2);
        $info3 = $this->info(3);
        $info4 = $this->info(4);
        $info5 = $this->info(5);
        $info6 = $this->info(6);
        $info7 = $this->info(7);
        $info8 = $this->info(8);
        $info9 = $this->info(9);
        $info10 = $this->info(10);
        $info11 = $this->info(11);
        $info12 = $this->info(12);
        $groupRow = DB::table('settable')->max('g_id');
        //var_dump($groupRow);exit;
        return view('group.checkgroup',['groupRow'=>$groupRow,'info1'=>$info1,'info2'=>$info2,'info3'=>$info3,'info4'=>$info4,'info5'=>$info5,'info6'=>$info6,'info7'=>$info7,'info8'=>$info8,'info9'=>$info9,'info10'=>$info10,'info11'=>$info11,'info12'=>$info12]);
    }
    /*成员移出小组*/
    public function Groupdel(Request $request){
        $u_id = $request->input('u_id');
        DB::table('settable')->where('u_id', $u_id)->delete();
        DB::table('user')
            ->where('u_id',$u_id)
            ->update(['is_group'=>0,'u_position'=>0]);
        return redirect('group_list');
    }
    /*判断小组是否有组长*/
    public function Hasleader(Request $request){
        $g_id = $request->input('g_id');
        $info = DB::table('settable')
            ->join('user', 'settable.u_id', '=', 'user.u_id')
            ->where('settable.g_id',$g_id)
            ->select('user.u_position')
            ->get();
        foreach($info as $k=>$v){
            if($v->u_position == 1){
                echo 1;
            }
        }
    }
//    /* 分配PK小组 */
//    public function groupMan(Request $request){
//        $u_id = $request->session()->get('u_id');
//        //echo $u_id;die;
//        $c_name = DB::table('user')
//            ->join('college','college.c_id','=','user.c_id')
//            ->join('class','class.cla_id','=','user.cla_id')
//            ->where('user.u_id',$u_id)
//            ->select('college.c_name','college.c_id','class.cla_id','class.cla_name')
//            ->get();
//        //var_dump($c_name);exit;
//        $group = DB::table('settable')
//            ->join('group','group.g_id','=','settable.g_id')
//            ->where('settable.c_id',$c_name[0]->c_id)
//            ->select('group.g_name','group.g_id')
//            ->distinct('group.g_name','group.g_id')
//            ->get();
//        $pk = DB::table('pkgroup')
//            ->where('pkgroup.cla_id',$c_name[0]->cla_id)
//            ->select('pkgroup.pk1','pkgroup.pk2')
//            ->get();
//        for($i=0;$i<count($pk);$i++){
//            foreach($pk[$i] as $k=>$v){
//                foreach($group as $key=>$val){
//                    if($v==$val->g_id){
//                        $group[$key]->curr = 1;
//                    }
//                }
//            }
//        }
//        return view('group.groupman',['c_name'=>$c_name,'group'=>$group]);
//    }
//    /*分配小组入库*/
//    public function pkadd(Request $request){
//        //echo 123;exit;
//        $c_id = $request->input('c_id');
//        $cla_id = $request->input('cla_id');
//        $pk1 = $request->input('pk1');
//        $pk2 = $request->input('pk2');
//
//        $res = DB::table('pkgroup')->insert([
//                ['c_id' => $c_id, 'cla_id' => $cla_id, 'pk1'=>$pk1, 'pk2'=>$pk2]
//            ]);
//        if($res){
//            return redirect('group/see_pk');
//        }
//    }
//    /*查看PK小组*/
//    public function see_pk(Request $request){
//        $u_id = $request->session()->get('u_id');
//        $c_name = DB::table('user')
//            ->join('college','college.c_id','=','user.c_id')
//            ->join('class','class.cla_id','=','user.cla_id')
//            ->where('user.u_id',$u_id)
//            ->select('college.c_name','college.c_id','class.cla_id','class.cla_name')
//            ->get();
//        $pk = DB::table('pkgroup')
//            ->join('class','class.cla_id','=','pkgroup.cla_id')
//            ->join('college','college.c_id','=','pkgroup.c_id')
//            ->join('group','group.g_id','=','pkgroup.pk1')
//            ->where('pkgroup.cla_id',$c_name[0]->cla_id)
//            ->select('class.cla_name','college.c_name','group.g_name','pkgroup.p_id')
//            ->get();
//        $pk2 = DB::table('pkgroup')
//        ->join('group','group.g_id','=','pkgroup.pk2')
//        ->where('pkgroup.cla_id',$c_name[0]->cla_id)
//        ->select('group.g_name')
//        ->get();
//        // var_dump($pk2);die;
//        for($i=0;$i<count($pk);$i++){
//            foreach($pk[$i] as $k=>$v){
//                for($j=0;$j<count($pk2);$j++){
//                    foreach($pk2[$j] as $key=>$val){
//                        if($i==$j){
//                            $pk[$i]->pk2 = $val;
//                        }
//                    }
//                }
//            }
//        }
//        return view('group.see_pk',['pk'=>$pk]);
//    }
    /*查看小组信息方法*/
    public function info($group_num){
        $info = DB::table('user')
            ->join('settable', 'settable.u_id', '=', 'user.u_id')
            ->join('group', 'settable.g_id', '=', 'group.g_id')
            ->join('class', 'user.cla_id', '=', 'class.cla_id')
            ->join('college', 'user.c_id', '=', 'college.c_id')
            ->where('group.g_id',$group_num)
            ->select('user.u_name','user.u_id','user.u_position', 'class.cla_name','college.c_name')
            ->get();
        //var_dump($info);exit;
        return $info;
    }
}