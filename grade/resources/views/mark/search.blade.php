<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>班级列表</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
    <script type="text/javascript" src="{{url('public/assets')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{url('public/assets')}}/js/js.js"></script>
    <link href="{{url('public/assets')}}/css/lyz.calendar.css" rel="stylesheet" type="text/css" />
</head>
<style>
    body {
        font-size: 12px;
        font-family: "微软雅黑", "宋体", "Arial Narrow";
    }
    body{ background:#EEEEEE;margin:0; padding:0; font-family:"微软雅黑", Arial, Helvetica, sans-serif; }
    a{ color:#006600; text-decoration:none;}
    a:hover{color:#990000;}
    .top{ margin:5px auto; color:#990000; text-align:center;}
    .info select{ border:1px #993300 solid; background:#FFFFFF;}
    .info{ margin:5px; text-align:center;}
    .info #show{ color:#3399FF; }
    .bottom{ text-align:right; font-size:12px; color:#CCCCCC; width:1000px;}
</style>
<body>
<div class="chuda_co" id="container">
    <div class="co-box">
        <div class="title">
            <h4>成绩管理>>搜索成绩</h4>
        </div>
        <div style="margin-left:30px; width:800px;">
            <div class="info">
                <div>
                    <select id="s_province" name="s_province"></select>  
                    <select id="s_city" name="s_city" ></select>  
                    <select id="s_county" name="s_county"></select>
                    <script class="resources library" src="area.js" type="text/javascript"></script>

                    <script type="text/javascript">_init_area();</script>
                </div>
                <div id="show"></div>
            </div>
        </div>
        <form action="{{url('Mark/add')}}" method="post" onsubmit="return check()">
            <div class="right">
                <div class="co-detail clearfix">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>学生姓名</th>
                            <th>理论成绩</th>
                            <th>机试成绩</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span></span></td>
                            <td><span id=""></span></td>
                            <td><<span id=""></span></td>
                        </tr>
                        <tr>
                            <td><span></span></td>
                            <td></td>
                            <td><span id=""></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="preview">
                    <input class="preview-btn btn01" type="submit" value="保存" ><input class="preview-btn btn01" type="reset" value="取消" >
                </div>
            </div>
        </form>
        <!--detail end-->
    </div>
</div>
</div>
</body>
</html>
<script>
    $('#college').change(function(){
        var id = $(this).val();

    });
</script>