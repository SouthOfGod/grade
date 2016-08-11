<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use Session;
use DB,PHPExcel;

header('content-type:text/html;charset=utf-8');
class AdministrController extends BaseController
{
	public function index()
	{
		return view('Administr.index');
	}

	/**
	 * 管理员上传
	 */
	public function add()
	{
	
		if(!empty($_FILES['file_stu']['name'])){
			$tmp_file = $_FILES['file_stu']['tmp_name'];
			$file_types = explode(".",$_FILES['file_stu']['name']);
			$file_type = $file_types[count($file_types)-1];
		}
		//判断不能为空
		if(empty($file_type)){
	        echo "<script>alert('请选择上传的文件！');</script>";
	        return view('Administr.index');
		}
		//判断上传文件类型
		if(strtolower($file_type)!="xls")
		{
			echo "<script>alert('不是Excel文件,重新上传');</script>";
			return view('Administr.index');
		}else{
			$PHPExcel = new \PHPExcel();
		    $objReader = \PHPExcel_IOFactory::createReader('Excel5');
		    //导入的excel路径
		    $tmp_file = $_FILES['file_stu']['tmp_name'];
		    $objPHPExcel=$objReader->load($tmp_file);
		    if($objPHPExcel){
		        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
		        //导入的excel路径
		        $excelpath=$_FILES['file_stu']['tmp_name'];
		        $objPHPExcel=$objReader->load($excelpath);
		    }
		    $sheet=$objPHPExcel->getSheet(0);
		    //取得总行数
		    $highestRow=$sheet->getHighestRow();
		    //取得总列数
		    $highestColumn=$sheet->getHighestColumn();
		    //从第二行开始读取数据  因为第一行是表格的表头信息
		    $sql = "";
		    for($j=2;$j<$highestRow;$j++){
		        $str = "";
		        //从A列读取数据
		        for ($k='A'; $k<=$highestColumn; $k++) {
		            $str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';
		            //读取单元格
		        }
		        $str = mb_convert_encoding($str, 'utf8', 'auto');//根据自己编码修改
		        $strs = explode("|*|", $str);
		        // 默认属性
		        $number = md5(123456);
		        $action = 'admin_list_role,admin_list';
				// 入库查询判断	        
		     	$c_id = DB::table('college')
			            ->where('college.c_name','=',"$strs[2]")
			            ->select('college.c_id')
			            ->get();
			    $cla_id = DB::table('class')
			            ->where('class.cla_name','=',"$strs[3]")
			            ->select('class.cla_id')
			            ->get();
			    $stu_number =  DB::table('user')
			            ->where('user.u_student_number','=',"$strs[1]")
			            ->select('user.*')
			            ->get();
			    if($stu_number){
			    	echo "<script>alert('学号不能重复');</script>";
			    	return view('Administr.index');
			    }
			    $c_id = $c_id[0]->c_id;
			    $cla_id = $cla_id[0]->cla_id;
		        //拼写sql语句
		        $sql[] = [
		            'u_name'=>"{$strs[0]}",
		            'u_pwd'=>"$number",
		            'u_student_number'=>"{$strs[1]}",
		            'u_addtime'=>time(),
		            'u_action_list'=>"$action",
		            'c_id'=>"$c_id",
		            'cla_id'=>"$cla_id"
		        ];
		    }
		    $res=DB::table('user')->insert($sql);
		    if($res){
		        echo "<script>alert('导入成功！');</script>";
		         return view('Administr.index');
		    }else{
		        echo "<script>alert('导入失败！');</script>";
		         return view('Administr.index');
		    }
		}	
	}

}