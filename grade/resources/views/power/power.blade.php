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
        <div class="title"><h4>权限管理>>新增权限</h4></div>
        <div class="fill-info">
            <div class="right">
                <a class="btn02" id="xg_btn" href="javascript:;">权限列表</a>
                <div class="info-box">
                    <ul>
                        <li>
                            <label>权限类型：</label>
                            <input type="radio" name="name"  value="" checked onclick="dis_child()">&nbsp;&nbsp;子权限&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="name"  value="" onclick="dis_parent()">&nbsp;&nbsp;父权限
                        </li>
                        <!--  父类的权限填写表单 -->
                        <div id="parent" style="display: none">
                            <li>
                                <label>权限名称：</label>
                                <input type="text" name="name" class="w200 name" value="">
                            </li>
                            <li>
                                <label>控制器名：</label>
                                <input type="text" name="name" class="w200 name" value="">
                            </li>
                            <li>
                                <label>是否启用：</label>
                                <input type="radio" name="name"  value="">&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="name"  value="">&nbsp;&nbsp;否
                            </li>
                            <li>
                                <label>描述：</label>
                                <input type="text" name="name" class="w200 name" value="">
                            </li>
                        </div>
                        <!--  父类的权限填写表单 -->
                        <div id="child">
                            <li>
                                <label>权限名称：</label>
                                <input type="text" name="name" class="w200 name" value="">
                            </li>
                            <li>
                                <label>父级权限：</label>
                                <select class="w200">
                                    <option>班级管理</option>
                                    <option>违纪管理</option>
                                </select>
                            </li>
                            <li>
                                <label>方法名：</label>
                                <input type="text" name="name" class="w200 name" value="">
                            </li>
                            <li>
                                <label>是否启用：</label>
                                <input type="radio" name="name"  value="">&nbsp;&nbsp;是&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="name"  value="">&nbsp;&nbsp;否
                            </li>
                            <li>
                                <label>描述：</label>
                                <input type="text" name="name" class="w200 name" value="">
                            </li>
                        </div>
                    </ul>
                </div>
                <div class="preview"> <a class="preview-btn btn01">保存</a> <a class="cancel-btn btn01">取消</a> </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function dis_child(){
        document.getElementById('child').style.display='block';
        document.getElementById('parent').style.display='none';
    }
    function dis_parent(){
        document.getElementById('child').style.display='none';
        document.getElementById('parent').style.display='block';
    }
</script>
