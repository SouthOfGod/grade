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
class CycleController extends BaseController
{
	/**
	 * 主页
	 * @return [type] [description]
	 */
	public function index()
	{
		$arr = array();
		for($i=1;$i<=12;$i++)
		{
			$arr[] = $i;
		}
		return view('cycle.index',['arr'=>$arr]);
	}

	/**
	 * 教学周期添加
	 * @param Request $request [description]
	 */
	public function add(Request $request)
	{
		$start_cycle = $request->input('start_cycle');
		$end_cycle = $request->input('end_cycle');
		$id = $request->input('frequency');
        //echo $end_cycle, $start_cycle;exit;
		if(empty($start_cycle)&&empty($end_cycle)){
			echo 0;exit;
		}
		$user =DB::table('cycle')
			->where('cy_id',$id)
			->update(['start_cycle' => "$start_cycle", 'end_cycle' => "$end_cycle"]);
		if($user){
			echo 1;
		}else{
            echo 2;
        }
		$request->session()->put('cy_id',"$id");
	}

	/**
	 * 分配日期
	 * @return [type] [description]
	 */
	public function date_list(Request $request)
	{
		$id = $request->session()->get('cy_id');
		$users = DB::table('cycle')
				->select('cycle.*')
				->where(['cy_id'=>"$id"])
				->get();
		$cy_id = $users[0]->cy_id;
		$start_cycle = $users[0]->start_cycle;
		$end_cycle = $users[0]->end_cycle;
		$start_cycle = strtotime($start_cycle);
		$end_cycle = strtotime($end_cycle);
	    $days = ($end_cycle-$start_cycle)/86400+1;
	    $date = array();
	    $dat = array();
	    for($i=0; $i<$days; $i++){
	        $date[] = date('Y-m-d', $start_cycle+(86400*$i));
	    }
	    foreach ($date as $key => $value) {
	    	 $dat[] = $this->get_week("$value");
	    }
	    $arr = [];
		foreach ($date as $key => $value) {
			$arr[$key]['aa'] = $value;
			$arr[$key]['bb'] = $dat[$key];
		}
		// print_r($arr);die;
	    return view('cycle.list',['date'=>$arr,'cy_id'=>$cy_id]);
	}

	/**
	 * 考试类型添加
	 * @return [type] [description]
	 */
	public function insert(Request $request)
	{
		$arr = $request->input('arr');
		$arr1 = $request->input('arr1');
		$id = $request->session()->get('cy_id');
		$xin = array();
		foreach ($arr as $key => $value) {
			foreach ($arr1 as $keys => $values) {
				if($key == $keys){
					$week = $this->get_week("$value");
					$xin["$value"]=['type'=>$values,'week'=>$week];
				}
			}
		}
        //print_r($xin);exit;
		$week = serialize($xin);
		$res = DB::table('exemdays')
				->where(['exem_id'=>$id])
				->update(  ['exem_days' => $week]);
		if($res){
			echo '1';
		}
	}


	/**
	 * 转换日期为星期
	 * @param  [type] $date [description]
	 * @return [type]       [description]
	 */
    public function  get_week($date){
	    //强制转换日期格式
	    $date_str=date('Y-m-d',strtotime($date));
	    //封装成数组
	    $arr=explode("-", $date_str);
	    //参数赋值
	    //年
	    $year=$arr[0];
	    //月，输出2位整型，不够2位右对齐
	    $month=sprintf('%02d',$arr[1]);
	    //日，输出2位整型，不够2位右对齐
	    $day=sprintf('%02d',$arr[2]);
	    //时分秒默认赋值为0；
	    $hour = $minute = $second = 0;
	    //转换成时间戳
	    $strap = mktime($hour,$minute,$second,$month,$day,$year);
	    //获取数字型星期几
	    $number_wk=date("w",$strap);
	    //自定义星期数组
	    $weekArr=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
	    //获取数字对应的星期
	    return $weekArr[$number_wk];
	}

	/**
	 * 周期列表
	 * @return [type] [description]
	 */
	public function show_list()
	{
		$arr = array();
		for($i=1;$i<=12;$i++)
		{
			$arr[] = $i;
		}
		return view('cycle.show_list',['arr'=>$arr]);
	}      

	public function ex_list(Request $request)
	{

		$id = $request->input('id');
		$days = DB::table('exemdays')
				->select('exem_days')
				->where(['exem_id'=>$id])
				->first();
		$exem = $days->exem_days;
		$user = unserialize($exem);
        //print_r($user);exit;
//        $str='';
//
//        $str .='<table border=1>';
//        $str .='<tr>';
//        $str .='<td>';
//        $str .='日期';
//        $str .='</td>';
//        $str .='<td>';
//        $str .='类型';
//        $str .='</td>';
//        $str .='<td>';
//        $str .='星期';
//        $str .='</td>';
//        $str .='</tr>';
//        for(var i=0;i<length;i++){
//        $str .='<tr>';
//        $str .='<td>';
//        $str .=msg[i];
//        $str .='</td>';
//        $str .='<td>';
//        $str .=msg[i].type;
//        $str .='</td>';
//        $str .='<td>';
//        $str .=msg[i].week;
//        $str .='</td>';
//        $str .='</tr>';
//        }
//        $str .='</table>';
		echo json_encode($user);
	}

	
}