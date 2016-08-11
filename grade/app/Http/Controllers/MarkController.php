<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Session;
use Illuminate\Http\Request;

header("content-type:text/html;charset=utf-8");
class MarkController extends BaseController
{
    /**
     * 成绩录入
     * @return [type] [description]
     */
    public function index(Request $request){
        $cla_id = $request->session()->get('cla_id');
        $now = time();
        $time = DB::table('mark')
            ->join('user','user.u_id','=','mark.u_id')
            ->where('user.cla_id','=',"$cla_id")
            ->max('m_time');

        $now = date('Y-m-d',$now);
        $time = date($time);
        if($now!=$time)
        {
            $users = DB::table('user')
                ->join('class', 'user.cla_id', '=', 'class.cla_id')
                ->join('college', 'college.c_id', '=', 'class.c_id')
                ->where('user.cla_id','=',"$cla_id")
                ->select('user.u_name', 'user.u_id','class.*', 'college.*')
                ->get();
        }
        else
        {
            $users = DB::table('user')
                ->join('class', 'user.cla_id', '=', 'class.cla_id')
                ->join('college', 'college.c_id', '=', 'class.c_id')
                ->join('mark','mark.u_id','=','user.u_id')
                ->where('user.cla_id','=',"$cla_id")
                ->orderBy('m_time', 'desc')
                ->select('user.u_name', 'user.u_id', 'mark.*' )
                ->get();
        }
        return view('mark.index',['arr'=>$users]);
    }

    /**
     * 成绩添加
     * @param Request $request [description]
     */
    public function add(Request $request){
      	$u_id = $request->input('u_id');
    	$m_theory = $request->input('m_theory');
    	$m_machine = $request->input('m_machine');
    	$time = time();
    	$str = '';
		foreach($u_id as $k=>$v){
		    foreach($m_theory as $key=>$val){
		        foreach($m_machine as $ke=>$va){
		            if($k==$key&&$key==$ke&&$k==$ke){
		                $str .= '(';
		                $str.= "$v".','."$val".','."$va".','."$time".',';
		                $str = substr($str,0,-1);
		                $str .= '),';
		            }
		        }
		    }
		}
		$str = substr($str,0,-1);
		$sql = "INSERT INTO rms_mark(u_id,m_machine,m_theory,m_time) VALUES".$str;
		$res = DB::insert($sql);
    	if($res){
    		return redirect('gradelist');
    	}
    	
    }

    /**
     * 查看成绩
     * @return [type] [description]
     */
    public function see_mark(Request $request){
        //获取用户id
        $id = $request->session()->get('u_id');
        $c_id = $request->session()->get('c_id');
        $cla_id = $request->session()->get('cla_id');
        //查看考试日期
        $month = date('m',time());
        $date = DB::table('exemdays')->where('exem_id',"$month")->first();
        $days = unserialize($date->exem_days);
        //获取登陆人的学院id与班级id
         //$user =DB::table('user')->where('u_id',$id)->select('c_id','cla_id')->first();
        if(empty($c_id)&&empty($cla_id))
        {
            $class = DB::table('class')->get();
            $college = DB::table('college')->get();
            return view('mark.search',['class'=>$class,'college'=>$college]);
            //echo "你必须通过搜索才能查询";exit();
        }
        //获取所有相同学院班级的学生信息
        $all_user = DB::table('user')->where('c_id',"$c_id")->where('cla_id',"$cla_id")->select('u_id')->get();
        $arr=array();
        foreach($all_user as $v){
            $arr[]=$v->u_id;
        }
        $str = implode(',',$arr);
        //获取所有学生的成绩按添加时间升序
        $grade = DB::table('mark')->whereIn('u_id',$arr)->orderBy('m_time', 'asc')
            ->get();
        //获取该班级的小组成员
        $group = DB::select("select g_id,GROUP_CONCAT(u_id) as u_id from rms_settable where u_id in($str) group by g_id");
        //print_r($group);exit;
        $grades = array();
        foreach($group as $key=>$val)
        {
            $grade = DB::select("select u_id,m_time,m_machine,m_theory,m_type from rms_mark where u_id in($val->u_id)");
            if(!empty($grade)){
                foreach($grade as $v)
                {
                    $users =DB::table('user')->where('u_id',$v->u_id)->select('u_name')->first();
                    foreach($days as $d => $y){
                        if($v->m_time == $d){
                            $grades["$val->g_id"]["$users->u_name"]["$d"] =  ['ji'=>$v->m_machine,'li'=>$v->m_theory];
                        }else{
                            $grades["$val->g_id"]["$users->u_name"]["$d"] = ['ji'=>'没录入','li'=>'没录入'];
                        }
                     }

                }
            }
        }
        //print_r($grades);exit;
        return view('mark.grade_list',['array_date'=>$days,'grades'=>$grades]);
    }
    /**
     * 搜索
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
    	$c_id = $request->get('c_id');
    	$cla_id = $request->get('cla_id');
    	$name = $request->get('name');
        if($c_id=='请选择学院'){
            echo "$c_id";exit();
        }
        if($c_id&$cla_id&$name){
            $users = DB::table('user')
                ->join('mark','mark.u_id','=','user.u_id')
                ->join('class','class.cla_id','=','user.cla_id')
                ->join('college','college.c_id','=','class.c_id')
                ->where('user.cla_id', '=', "$cla_id")
                ->where('user.u_name','=',"$name")
                ->where('class.c_id','=',"$c_id")  
                ->where('mark.m_status','=','1')     
                ->select('user.u_name','user.u_id','mark.m_theory','mark.m_machine','mark.m_time','mark.m_status','class.cla_name','college.c_name')
                ->get();
            echo json_encode($users);exit();
        }
        if($c_id&$cla_id){
            $users = DB::table('user')
                ->join('mark','mark.u_id','=','user.u_id')
                ->join('class','class.cla_id','=','user.cla_id')
                ->join('college','college.c_id','=','class.c_id')
                ->where('user.cla_id', '=', "$cla_id")
                ->where('class.c_id','=',"$c_id") 
                ->where('mark.m_status','=','1')      
                ->select('user.u_name','user.u_id','mark.m_theory','mark.m_machine','mark.m_time','mark.m_status','class.cla_name','college.c_name')
                ->get();
            echo json_encode($users);exit();
        }
	}


    /**
     * 成绩审核
     * @return [type] [description]
     */
    public function check_mark(){
    	$users = DB::table('user')
	        ->join('class', 'user.cla_id', '=', 'class.cla_id')
	        ->join('college', 'college.c_id', '=', 'class.c_id')
	        ->join('mark', 'user.u_id', '=', 'mark.u_id')
	        ->where('mark.m_status','=',"0")
	        ->select('user.u_name', 'user.u_id','class.*', 'college.*', 'mark.*')
	        ->paginate(5);      
        return view('mark.check_mark',['arr'=>$users]);
    }

    /**
     * 成绩状态修改
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function check(Request $request){
    	$u_id = $request->get('u_id');
    	$u_id = explode(',',$u_id);
    	$res = DB::table('mark')
            ->whereIn('u_id',$u_id)
            ->update(['m_status' => 1]);
        if($res){
        	return redirect('check_grade');
        }
    }

    /**
     * 成绩分析
     * @return [type] [description]
     */
    public function analyse(Request $request){
        $cla_id = $request->session()->get('cla_id');
        $mini = DB::table('mark')
            ->join('user','user.u_id','=','mark.u_id')
            ->join('class','class.cla_id','=','user.cla_id')
            ->where('m_type','周考')
            ->where('user.cla_id',$cla_id)
            ->select('mark.m_machine','mark.m_theory','class.cla_name')
            ->orderBy('m_time','desc')
            ->get();
        if(!empty($mini)){
            $i = 1;
            $j = 1;
            foreach($mini as $k=>$v){
                $data['cla_name'] = $mini[$k]->cla_name;
                if($v->m_machine>=90&&$v->m_theory>=90){
                    $data['qualified'] = $i++;
                    $data['off-grade'] = $j-1;
                }else{
                    $data['off-grade'] = $j++;
                    $data['qualified'] = $i-1;
                }
            }
            $data['mark'] = '';
        }else{
            $data['cla_name'] = '';
            $data['mark'] = '周考成绩尚未录入';
            $data['qualified'] = '';
            $data['off-grade'] = '';
        }
        return view('mark.analyse',['data'=>$data]);
    }
}