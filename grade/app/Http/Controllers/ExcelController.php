<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel,DB;
require_once (__DIR__."/../../../vendor/PHPExcel.php");
class ExcelController extends Controller
{
    public function import(Request $request)
    {
        $time = $request->input('time');
        if(empty($time)){
            echo "<script>alert('时间不能为空！');location.href='add_grade'</script>";
        }
        $PHPExcel = new \PHPExcel();
        //这里是导入excel2007 的xlsx格式，如果是2003格式可以把“excel2007”换成“Excel5"
        //怎么样区分用户上传的格式是2003还是2007呢？可以获取后缀  例如：xls的都是2003格式的
        //xlsx 的是2007格式的  一般情况下是这样的
        if(!empty($_FILES['myfile']['name'])){
            $file_types = explode(".",$_FILES['myfile']['name']);
            $file_type = $file_types[count($file_types)-1];
        }
        if( $file_type =='xlsx' )
        {
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        }
        else
        {
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        }
        //导入的excel路径
        $excelpath=$_FILES['myfile']['tmp_name'];
        if(empty($excelpath)){
            echo "<script>alert('请选择上传的文件！');location.href='add_grade'</script>";
        }
        @$objPHPExcel=$objReader->load($excelpath);
        if($objPHPExcel){
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            //导入的excel路径
            $excelpath=$_FILES['myfile']['tmp_name'];
            $objPHPExcel=$objReader->load($excelpath);
        }
        $sheet=$objPHPExcel->getSheet(0);
        //取得总行数
        $highestRow=$sheet->getHighestRow();

        //取得总列数
        $highestColumn=$sheet->getHighestColumn();

        //从第二行开始读取数据  因为第一行是表格的表头信息
        $sql = "";
        for($j=2;$j<=$highestRow;$j++) {
            $str = "";
            //从A列读取数据
            for ($k='B'; $k <= $highestColumn; $k++) {
                $str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue() . '|*|';//读取单元格
            }
            $str = mb_convert_encoding($str, 'utf8', 'auto');//根据自己编码修改
            $strs = explode("|*|", $str);
            //print_r($strs);die;
            $class = DB::table('user') -> where('u_name' , $strs[0]) -> first();
           // var_dump($class);die;
            if(empty($class)){
                echo "<script>alert('用户不存在！');location.href='add_grade'</script>";
            }
            $u_id=$class->u_id;
            //拼写sql语句
            $sql[] = [
                'u_id' => "{$u_id}",
                'm_machine'=>"{$strs[1]}",
                'm_theory'=>"{$strs[2]}",
                'm_time'=>"{$time}",
                'm_type'=>"{$strs[3]}"
            ];
        }
        $res=DB::table('mark')->insert($sql);
        if($res){
            echo "<script>alert('导入成功！');location.href='add_grade'</script>";
        }else{
            echo "<script>alert('导入失败！');location.href='from'</script>";
        }
    }



//Excel文件导出功能
    public function export(Request $request){
        $name = $request->input('name');
        $search = $request->input('search');
        $cla = $request->input('cla');
        if($search=="请选择学院"){
            echo "<script>alert('请选择学院！');location.href='grade_list'</script>";
        }
        if($cla=="请选择班级"){
            echo "<script>alert('请选择班级！');location.href='grade_list'</script>";
        }
        $users = DB::table('user')
            ->join('class', 'user.cla_id', '=', 'class.cla_id')
            ->join('college', 'college.c_id', '=', 'class.c_id')
            ->join('mark', 'user.u_id', '=', 'mark.u_id')
            ->where('user.cla_id','=',"$cla")
            ->where('mark.m_status','=','1')
            ->where('college.c_id','=',"$search" and  'user.u_name','=',"$name" )
            ->select('user.u_name', 'user.u_id','class.*', 'college.*', 'mark.*')
            ->get();
        $cellData[] = ['姓名','理论成绩','机试成绩','班级名称','添加时间'];
        foreach ($users as $k=> $v) {
            $cellData[] = array(
                '姓名' => $v->u_name,
                '理论成绩' => $v->m_machine,
                '机试成绩' =>$v->m_theory,
                '班级名称' => $v->cla_name,
                '添加时间' => $v->m_time,
            );
        }
        Excel::create('学生成绩',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->store('xls')->export('xls');

    }
}
