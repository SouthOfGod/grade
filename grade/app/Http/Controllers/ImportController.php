<?php
/**
 * Created by PhpStorm.
 * User: ASUS-
 * Date: 2016/8/8
 * Time: 8:40
 */

namespace App\Http\Controllers;


class ImportController  extends BaseController   {
//从数据表导出到excel
    function export(){
        //echo $table_name;
        //$table_name = $this->uri->segment(3,1);
        $table_name = "ecs_brand";//获取表名
        $query = $this -> db -> get($table_name);//查询该表记录
        //print_r($query);
        if(!$query)return false;
        // StartingthePHPExcellibrary
        $this->load->library('PHPExcel');
        $this ->load ->library('PHPExcel/IOFactory');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()-> setTitle("export") -> setDescription("none");
        $objPHPExcel -> setActiveSheetIndex(0);
        // Fieldnamesinthefirstrow
        $fields = $query -> list_fields();
        $col = 0;
        foreach($fields as $field){
            $objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($col, 1,$field);
            $col++;
        }
        // Fetchingthetabledata
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col,$row,$data->$field);
                $col++;
            }
            $row++;
        }
        $objPHPExcel -> setActiveSheetIndex(0);
        $objWriter = IOFactory :: createWriter($objPHPExcel, 'Excel5');
        // Sendingheaderstoforcetheusertodownloadthefile
        header('Content-Type:application/vnd.ms-excel');
        //header('Content-Disposition:attachment;filename="Products_' . date('dMy') . '.xls"');
        header('Content-Disposition:attachment;filename="'.$table_name . '_' . date('Y-m-d') . '.xls"');
        header('Cache-Control:max-age=0');
        $objWriter -> save('php://output');
    }


    //指定excel文件路径，读出文件内容
    public function read($fullpath){
        //$filename = "public/upfile/excel/20151223061123.xls";
        $filename = $fullpath;
        $this ->load ->library('PHPExcel/IOFactory');
        $objReader = IOFactory::createReader('Excel5');
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($filename);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        //echo $highestRow;
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $excelData = array();
        for($row = 1; $row <= $highestRow; $row++) {
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $excelData[$row][]=(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
        }
        //print_r($excelData);
        return $excelData;
        //$excelData为多维数组，直接操作该数组完成入库操作即可。
    }



    //从excel导入到数据表
    function import(){
        $this->load->view('excel_import3.html');
    }


    //从excel导入到数据表
    function import_pro(){
        //要处理的excel文件
        //$fullpath = './sampleData/example2.xls';//指定文件
        //$re = $this->read($fullpath,'utf-8');

        //用用选择excel文件
        //print_r($_FILES);
        $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
        $file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
        $file_type = $file_types [count ( $file_types ) - 1];
        //判别是不是.xls文件，判别是不是excel文件
        if (strtolower ( $file_type ) != "xls"){
            $this->error ( '不是Excel文件，重新上传' );
        }
        $savePath = "public/upfile/excel/";
        //以时间来命名上传的文件
        $str = date ( 'Ymdhis' );
        $file_name = $str . "." . $file_type;
        //是否上传成功
        if(!copy($tmp_file,$savePath.$file_name)){
            $this->error ( '上传失败' );
        }
        $fullpath = $savePath.$file_name;
        echo $fullpath;

        $re = $this->read($fullpath);//调用读取方法read()
        unset($re[1]);
        unset($re[2]);
        print_r($re);
        //对$re中的数据做入库处理。略。。
    }





}