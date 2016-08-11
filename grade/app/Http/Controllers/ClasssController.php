<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

header("content-type:text/html;charset=utf-8");
class ClasssController extends BaseController
{
    /* 分配小组 */
    public function index(Request $request){
        // $c_id = $request->input('c_id');
        // if(isset($c_id)){
        //     $classinfo = DB::table('class')
        //         ->where('c_id',$c_id)
        //         ->get();
        //     var_dump($classinfo);
        //     $pk = DB::table('pkclass')
        //         ->where('pkclass.c_id',$c_id)
        //         ->select('pkclass.pk1','pkclass.pk2')
        //         ->get();
        //     for($i=0;$i<count($pk);$i++){
        //         foreach($pk[$i] as $k=>$v){
        //             foreach($classinfo as $key=>$val){
        //                 if($v==$val->cla_id){
        //                     $classinfo[$key]->curr = 1;
        //                 }
        //             }
        //         }
        //     }
        //     echo json_encode($classinfo);
        // }else{
            $info = DB::table('college')
                ->get();
            return view('classs.classs',['info'=>$info]);
        // }
    }

    /* 一键生成 */
    public function pkadd(Request $request){
        $c_id = $request->input('c_id');
        $bb = DB::table('class')
            ->where('c_id',$c_id)
            ->get();
        if(!empty($bb)){
            $aa = DB::table('pkclass')
	            ->where('c_id',$c_id)
	            ->get();
	        if($aa){
	            $inf['err'] = 1;
	            $inf['msg'] = '该学院PK班级已经分配';
	        }else{
	            $sql = 'SELECT c_stage,GROUP_CONCAT(cla_id) AS cla FROM rms_class WHERE c_id='.$c_id.' GROUP BY c_stage';
	            $classs = DB::select($sql);
	            foreach($classs as $k=>$v){
	                $data[] = explode(',',$v->cla);
	            }
	            
	            foreach($data as $k=>$v){
	                if(count($data[$k])==1){
	                    $where[] = $this->getstage(count($data[$k]),$v,$c_id);
	                }else if(count($data[$k])/3==1){
	                    $where[] = $this->getstage(count($data[$k]),$v,$c_id);
	                }else if(count($data[$k])%2==0){
	                    $where[] = $this->getstage(count($data[$k]),$v,$c_id);
	                }else{
	                    $where[] = $this->getstage(count($data[$k]),$v,$c_id);
	                }
	            }
	            if($where){
	                foreach($where as $k=>$v){
	                    $count[] = count($v);
	                }

	                for($i=0;$i<count($count);$i++){
	                    if($count[$i]==2){
	                        $info[] = ['pk1'=>$where[$i][0],'pk2'=>$where[$i][1]];
	                    }else if($count[$i]==3){
	                        $info[] = ['pk1'=>$where[$i][0],'pk2'=>$where[$i][1]];
	                        $info[] = ['pk1'=>$where[$i][1],'pk2'=>$where[$i][2]];
	                        $info[] = ['pk1'=>$where[$i][0],'pk2'=>$where[$i][2]];
	                    }else if($count[$i]==4){
	                        $info[] = ['pk1'=>$where[$i][0],'pk2'=>$where[$i][1]];
	                        $info[] = ['pk1'=>$where[$i][2],'pk2'=>$where[$i][3]];
	                    }else if($count[$i]==5){
	                        $info[] = ['pk1'=>$where[$i][0],'pk2'=>$where[$i][1]];
	                        $info[] = ['pk1'=>$where[$i][1],'pk2'=>$where[$i][2]];
	                        $info[] = ['pk1'=>$where[$i][0],'pk2'=>$where[$i][2]];
	                        $info[] = ['pk1'=>$where[$i][3],'pk2'=>$where[$i][4]];
	                    }else if($count[$i]==6){
	                        $info[] = ['pk1'=>$where[$i][0],'pk2'=>$where[$i][1]];
	                        $info[] = ['pk1'=>$where[$i][2],'pk2'=>$where[$i][3]];
	                        $info[] = ['pk1'=>$where[$i][4],'pk2'=>$where[$i][5]];
	                    }else if($count[$i]==7){
	                        $info[] = ['pk1'=>$where[$i][0],'pk2'=>$where[$i][1]];
	                        $info[] = ['pk1'=>$where[$i][1],'pk2'=>$where[$i][2]];
	                        $info[] = ['pk1'=>$where[$i][0],'pk2'=>$where[$i][2]];
	                        $info[] = ['pk1'=>$where[$i][3],'pk2'=>$where[$i][4]];
	                        $info[] = ['pk1'=>$where[$i][5],'pk2'=>$where[$i][6]];
	                    }
	                }
	                for($i=0;$i<count($info);$i++){
	                    $info[$i]['c_id'] = $c_id;
	                }
	                foreach($info as $k=>$v){
	                    $str[] = implode(',', $v);
	                }
	                $str = array_unique($str);
	                sort($str);
	                for($i=0;$i<count($str);$i++){
	                    $dat[] = explode(',',$str[$i]);
	                }
	                $data = [];
	                foreach($dat as $k=>$v){
	                    $data[$k]['pk1'] = $v[0];
	                    $data[$k]['pk2'] = $v[1];
	                    $data[$k]['c_id'] = $v[2];
	                }
	                $res = DB::table('pkclass')
	                    ->insert($data);
	                if($res){
	                    $inf['err'] = 0;
	                }
	            }        
	        } 
        }else{
			$inf['err'] = 1;
			$inf['msg'] = '该学院还没有班级';
		}    		

		echo json_encode($inf);
			// var_dump($data); die;
            // $str = 666;
            // foreach($data as $k=>$v){
            //     if($str != 666){
            //         $v[] = $str;
            //         $str = 666;
            //     }
            //     print_r($v);
            //         switch (count($data[$k]))
            //         {
            //             case 1:
            //               $str = $v[0];
            //               continue;
            //             case 2:
            //               $where[] = $v;
            //               continue;
            //             case 3:
            //               $where[] = $v;
            //               continue;
            //             case 4:
            //               $where[] = $v;
            //               continue;
            //             case 5:
            //               $where[] = $v;
            //               continue;
            //             case 6:
            //               $where[] = $v;
            //               break;       
            //         }
            // }
            // exit;
            // print_r($where);die;   
    }

    public function getstage($count='',$data=[],$c_id){
        if($count==1){
            $classs = DB::table('class')
                ->where('c_id',$data[0])
                ->select('c_stage')
                ->first();    
            $clas = DB::table('class')
                ->where('c_stage',$classs->c_stage-1)
                ->where('c_id',$c_id)
                ->select('cla_id')
                ->get(); 
            if(empty($clas)){
                $clas = DB::table('class')
                    ->where('c_stage',$classs->c_stage+1)
                    ->where('c_id',$c_id)
                    ->select('cla_id')
                    ->get(); 
            }
            $clas[]=DB::table('class')
                    ->where('c_stage',$classs->c_stage)
                    ->where('c_id',$c_id)
                    ->select('cla_id')
                    ->first(); 
                    // var_dump($clas);
            foreach($clas as $k=>$v){
                $data[$k] = $v->cla_id;
            }     
            $data = $this->getstage(count($data),$data,$c_id); 
            return $data;     
        }else if($count/3==1){
            return $data;
        }else if($count%2==0){
            return $data;
        }else{
            return $data;
        }
    }
    // /* 获取每个阶段班级*/
    // public function getstage(Request $request){
    //     $c_id = $request->input('c_id');
    //     $cla_id = $request->input('cla_id');
    //     $stage = DB::table('class')
    //         ->where('c_id',$c_id)
    //         ->where('cla_id',$cla_id)
    //         ->select('c_stage')
    //         ->first();
    //     $info['msg'] = 1;
    //     $getstage = DB::table('class')
    //         ->where('cla_id','!=',$cla_id)
    //         ->where('c_stage',$stage->c_stage)
    //         ->where('c_id',$c_id)
    //         ->get();
    //     if(empty($getstage)){
    //         $getstage = DB::table('class')
    //             ->where('cla_id','!=',$cla_id)
    //             ->where('c_stage',$stage->c_stage-1)
    //             ->where('c_id',$c_id)
    //             ->get();
    //         $count = count($getstage)+1;
    //         if(($count)%2==1){
    //             $pk1 = $request->input('pk1');
    //             if(isset($pk1)){
    //                 $getstage = DB::table('class')
    //                     ->where('cla_id','!=',$cla_id)
    //                     ->where('cla_id','!=',$pk1)
    //                     ->where('c_stage',$stage->c_stage-1)
    //                     ->where('c_id',$c_id)
    //                     ->get();
    //             }else{
    //                 $getstage = DB::table('class')
    //                     ->where('cla_id','!=',$cla_id)
    //                     ->where('c_stage',$stage->c_stage-1)
    //                     ->where('c_id',$c_id)
    //                     ->get();
    //             }
    //         }
    //         $info['msg'] = 0;
    //     }else{
    //         if(count($getstage)%2==1){
    //             $pk1 = $request->input('pk1');
    //             if(isset($pk1)){
    //                 $getstage = DB::table('class')
    //                     ->where('cla_id','!=',$cla_id)
    //                     ->where('cla_id','!=',$pk1)
    //                     ->where('c_stage',$stage->c_stage)
    //                     ->where('c_id',$c_id)
    //                     ->get();
    //             }else{
    //                 $getstage = DB::table('class')
    //                     ->where('cla_id','!=',$cla_id)
    //                     ->where('c_stage',$stage->c_stage)
    //                     ->where('c_id',$c_id)
    //                     ->get();
    //             }
    //         }else{
    //             $pk1 = $request->input('pk1');
    //             if(isset($pk1)){
    //                 $getstage = DB::table('class')
    //                     ->where('cla_id','!=',$cla_id)
    //                     ->where('cla_id','!=',$pk1)
    //                     ->where('c_stage',$stage->c_stage)
    //                     ->where('c_id',$c_id)
    //                     ->get();
    //                 if(count($getstage)%2==0){
    //                     $getstage = [];
    //                 }
    //             }else{
    //                 $getstage = DB::table('class')
    //                     ->where('cla_id','!=',$cla_id)
    //                     ->where('c_stage',$stage->c_stage)
    //                     ->where('c_id',$c_id)
    //                     ->get();
    //             }
    //         }
    //         $info['msg'] = 0;
    //     }
    //     if(!empty($getstage)){
    //         $pk = DB::table('pkclass')
    //             ->where('pkclass.c_id',$c_id)
    //             ->select('pkclass.pk1','pkclass.pk2')
    //             ->get();
    //         for($i=0;$i<count($pk);$i++){
    //             foreach($pk[$i] as $k=>$v){
    //                 foreach($getstage as $key=>$val){
    //                     if($v==$val->cla_id){
    //                         $getstage[$key]->curr = 1;
    //                     }
    //                 }
    //             }
    //         }
    //         $info['data'] = $getstage;
    //     }else{
    //         $info['msg'] = 1;
    //     }
    //     echo json_encode($info);
    // }

    // /* PK组添加*/
    // public function pkadd(Request $request){
    //     $c_id = $request->input('c_id');
    //     $pk1 = $request->input('pk1');
    //     $pk2 = $request->input('pk2');
    //     $pk3 = $request->input('pk3');
    //     if($pk3=="null"){
    //         $data = ['c_id'=>$c_id,'pk1'=>$pk1,'pk2'=>$pk2];
    //         $res = DB::table('pkclass')->insert($data);
    //     }else{
    //         $data1 = ['c_id'=>$c_id,'pk1'=>$pk1,'pk2'=>$pk2];
    //         $data2 = ['c_id'=>$c_id,'pk1'=>$pk2,'pk2'=>$pk3];
    //         $data3 = ['c_id'=>$c_id,'pk1'=>$pk1,'pk2'=>$pk3];
    //         $res = DB::table('pkclass')->insert([$data1,$data2,$data3]);
    //     }
    //     if($res){
    //         $info['err'] = 0;
    //     }else{
    //         $info['err'] = 1;
    //     }
    //     echo json_encode($info);
    // }

    /* 查看PK组 */
    public function show(){
        $pk = DB::table('pkclass')
            ->join('college','college.c_id','=','pkclass.c_id')
            ->join('class','class.cla_id','=','pkclass.pk1')
            ->select('class.cla_name','college.c_name','pkclass.id')
            ->get();
        $pk2 = DB::table('pkclass')
            ->join('class','class.cla_id','=','pkclass.pk2')
            ->select('class.cla_name')
            ->get();
        for($i=0;$i<count($pk);$i++){
            foreach($pk[$i] as $k=>$v){
                for($j=0;$j<count($pk2);$j++){
                    foreach($pk2[$j] as $key=>$val){
                        if($i==$j){
                            $pk[$i]->pk2 = $val;
                        }
                    }
                }
            }
        }
        return view('classs.show',['pk'=>$pk]);
    }
}