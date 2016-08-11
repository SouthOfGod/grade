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
class BanController extends BaseController
{

    /*表单页面*/
    public function add_class(){
        $data= DB::table('college')
            ->get();
        //var_dump($data);die;
        return view('ban.add_class',['data'=>$data]);
    }

    /* 新增班级 */
    public function index(Request $request){

        //接收值
        $cla_name=$request->input('cla_name');
        $c_id=$request->input('c_id');

        $res=DB::table('class')->insert([

            'cla_name'=>$cla_name,
            'c_id'=>$c_id
       ]);
        if($res){
            return redirect('class_list');
        }else{

            echo "添加失败";
        }
    }

    /* 班级列表 */
    public function class_list(Request $request){

            $date= DB::table('class')
                ->join('college','college.c_id','=','class.c_id')
                ->paginate(5);

        //查询学院
        $college= DB::table('college')
            ->get();

            return view('ban.class_list',['date'=>$date,'college'=>$college]);
}

    //搜索班级
    public function findban(Request $request){

            //接收搜索框的值
        $c_id=$request->input('c_id');

            $result=DB::table('college')
            ->where('class.c_id',$c_id)
            ->join('class','class.c_id','=','college.c_id')
            ->paginate(3);
        //查询学院
        $college= DB::table('college')
                ->get();
         return view('ban.class_lists',['check'=>$c_id,'result'=>$result,'college'=>$college]);

    }

}