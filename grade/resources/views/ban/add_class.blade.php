<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>新增班级</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
</head>

<body>
<div class="chuda_co" id="container">
    <div class="co-box">
        <div class="title"><h4>班级管理>>新增班级</h4></div>
        <div class="fill-info">
            <form action="{{url('Ban/index')}}" method="post">
            <div class="right">

                <div class="info-box">
                    <ul>
                        <li>
                            <label>选择学院：</label>
                            <select name="c_id">
                                <option value="0">--请选择--</option>
                                <?php foreach($data as $k=>$v){?>
                                <option value="<?=$v->c_id?>"><?=$v->c_name?></option>
                                <?php } ?>
                            </select>
                        </li>
                        <li>
                            <label>班级名称：</label>
                            <input type="text" name="cla_name" class="w200 name" value="">
                        </li>

                    </ul>
                </div>
                <div class="preview">
                    <input class="preview-btn btn01" type="submit" value="保存" >
                    <input class="preview-btn btn01" type="reset" value="取消" >
                </div>
            </div>
        </div>
    </div></div>
</body>
</html>
