<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>班级列表</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
    <script type="text/javascript" src="{{url('public/assets')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{url('public/assets')}}/js/js.js"></script>
    <link href="{{url('public/assets')}}/css/lyz.calendar.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{url('public/assets')}}/js/jquery-1.5.1.js"></script>
    <script src="{{url('public/assets')}}/js/lyz.calendar.min.js" type="text/javascript"></script>
</head>
<style>
    body {
        font-size: 12px;
        font-family: "微软雅黑", "宋体", "Arial Narrow";
    }
</style>
<body>
<div class="chuda_co" id="container">
    <div class="co-box">
        <div class="title">
            <h4>成绩管理>>录入成绩</h4>
        </div>
        <div style="margin-left:30px; width:800px;">
            <form method="post" action="{{URL('import')}}" enctype="multipart/form-data"style="color: #ff7231">
                <span id="rq" style="float: left">
            请选择日期：<input id="txtBeginDate" neme="time" style="width:170px;
            height:30px; padding:7px 10px;border:1px solid #ccc;margin-right:10px;  "/>(*必填)
                </span>
                <input type="file"id="myfile" name="myfile" style="float: left;    color: #dc7fff" />
            <input type="submit"  value="导入成绩表" style="color: #6546ff; background: #c1d2ee"/>
            </form>
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
                    <?php foreach($arr as $v){?>
                    <?php if(empty($v->m_theary)&&empty($v->m_machine)){?>
                    <tr>
                        <td><span><?php echo $v->u_name?><input type="hidden" name='u_id[]' value="<?=$v->u_id?>" /></span></td>
                        <td><input type="text" name="m_theory[]" id="theory_<?=$v->u_id?>" onblur="check_theory(<?=$v->u_id?>)" />&nbsp;&nbsp;分&nbsp;&nbsp;<span id="t_<?=$v->u_id?>"></span></td>
                        <td><input type="text" name="m_machine[]" id="machine_<?=$v->u_id?>" onblur="check_machine(<?=$v->u_id?>)" />&nbsp;&nbsp;分&nbsp;&nbsp;<span id="m_<?=$v->u_id?>"></span></td>
                    </tr>
                    <?php }else{?>
                    <tr>
                        <td><span><?php echo $v->u_name?><input type="hidden" name='u_id[]' value="<?=$v->u_id?>" /></span></td>
                        <td><input type="text" name="m_theory[]" disabled id="theory_<?=$v->u_id?>" value="<?=$v->m_theory?>" />&nbsp;&nbsp;分&nbsp;&nbsp;<span id="t_<?=$v->u_id?>"></span></td>
                        <td><input type="text" name="m_machine[]" disabled id="machine_<?=$v->u_id?>" value="<?=$v->m_machine?>" />&nbsp;&nbsp;分&nbsp;&nbsp;<span id="m_<?=$v->u_id?>"></span></td>
                    </tr>
                    <?php }?>
                    <?php }?>
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
    $(function () {
        $("#txtBeginDate").calendar({
            controlId: "divDate",                                 // 弹出的日期控件ID，默认: $(this).attr("id") + "Calendar"
            speed: 200,                                           // 三种预定速度之一的字符串("slow", "normal", or "fast")或表示动画时长的毫秒数值(如：1000),默认：200
            complement: true,                                     // 是否显示日期或年空白处的前后月的补充,默认：true
            readonly: true,                                       // 目标对象是否设为只读，默认：true
            upperLimit: new Date(),                               // 日期上限，默认：NaN(不限制)
            lowerLimit: new Date("2011/01/01"),                   // 日期下限，默认：NaN(不限制)
            callback: function () {
                var data=$("#txtBeginDate").val()
                $("#rq").html( "请选择日期：<input type='text' name='time' value='"+data+"'/>")

            }
        });
    });

    function dr(){
        var time=$("#txtBeginDate").val();
        var myfile=$("#myfile").val();
        $.ajax({
            type: "POST",
            url: "{{URL('import')}}",
            enctype: 'multipart/form-data',
            data: {
                file: myfile,time:time
            },
            success: function (msg) {
                alert(msg);
            }
        });
    }














    sgin = 1;
    sign = 1;
    function check_machine(id)
    {
        var m_machine = $('#machine_'+id).val();
        if(m_machine!="")
        {
            $('#m_'+id).html("");
            sgin = 0;
        }
        else
        {
            $('#m_'+id).html("<font color='red'>不能为空</font>");
            sgin = 1;
        }
    }
    function check_theory(id)
    {
        var m_theory = $('#theory_'+id).val();
        if(m_theory!="")
        {
            $('#t_'+id).html("");
            sign = 0;
        }
        else
        {
            $('#t_'+id).html("<font color='red'>不能为空</font>");
            sign = 1;
        }
    }
    function check()
    {
//        alert(check_theory());return false;
        if(sgin==0&&sign==0)
        {
            return true;
        }
        else
        {

            alert('请检查好是否填写完全，一经提交不可修改');
            return false;
        }
    }
</script>
