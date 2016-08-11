<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>新增班级</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/hdw.css" />
</head>

<body>
<div class="chuda_co" id="container">
    <div class="co-box">
        <div class="title"><h4>小组管理>>分配小组</h4></div>
        <div class="fill-info">
            <div class="info-box">
                <div>
                    <ul>
                        <li>
                            <label>分配小组：</label>
                            <select class="group" name="">
                                    @for($i=1;$i<=12;$i++)
                                    <option value="{{$i}}">{{$i}}组</option>
                                    @endfor
                            </select>
                            <font color="red">还可以添加<strong id="num"> </strong>人</font>
                        </li>
                    </ul>
                </div>
                <div class="content">
                    <select class="select" multiple="multiple" id="select1" style="height: 350px">
                        @foreach($user as $k=>$v)
                        <option leader='0' value="{{$v->u_id}}">{{$v->u_name}}</option>
                        @endforeach
                    </select>
                    <span id="add">选中右移>></span>
                </div>
                <div class="content">
                    <select class="select" multiple="multiple" id="select2" style="height: 350px">

                    </select>
                    <span id="remove">选中左移>></span>
                </div>
                <div>
                    <a class="preview-btn btn01" id="assign">指定组长</a>
                </div>
            </div>
            <div class="preview"> <a class="preview-btn btn01" id="save">保存</a> <a class="cancel-btn btn01">取消</a> </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="{{url('public/assets')}}/js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="{{url('public/assets')}}/js/hdw.js"></script>

