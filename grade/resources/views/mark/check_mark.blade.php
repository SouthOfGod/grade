<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>班级列表</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
    <script type="text/javascript" src="{{url('public/assets')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{url('public/assets')}}/js/js.js"></script>
</head>

<body>
<div class="chuda_co" id="container">
    <div class="co-box">
        <div class="title">
            <h4>成绩管理>>查看成绩</h4>
        </div>
        <div>
            <input type="button" id='pcheck' value='批量审核' class='preview-btn btn01'/>
        </div>
    <div class="right">
        <div class="co-detail clearfix">
            <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th><input type="checkbox" id="checkall" />&nbsp;&nbsp;全选</th>
                    <th>姓名</th>
                    <th>机试成绩</th>
                    <th>理论成绩</th>
                    <th>班级名称</th>
                    <th>学院名称</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($arr as $v) { ?>            
                <tr>
                    <td><input type="checkbox" name="check" class="check" value='{{$v->u_id}}'/>&nbsp;&nbsp;<?= $v->u_id?></td>
                    <td><?= $v->u_name?></td>
                    <td><?= $v->m_machine?></td>
                    <td><?= $v->m_theory?></td>
                    <td><?= $v->cla_name?></td>
                    <td><?= $v->c_name?></td>
                    <td><?= $v->m_time?></td>
                    <td>
                        <input type='button' value='审核' class='check_status' value='{{$v->u_id}}' >
                    </td>
                </tr> 
                <?php } ?>  
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
<!--分页-->
{!! $arr->links() !!}
</body>
</html>

<script src="{{URL('public/assets')}}/js/jquery.js"></script>
<script>
//批量审核的传值
$("#pcheck").click(function(){
    var str = "";
    $('.check:checked').each(function(){
        str += ','+$(this).val();
    })
    str = str.substr(1);
    if(str=="")
    {
        alert('至少选择一个ID');
    }
    else
    {
        location.href="{{URL('check')}}?u_id="+str;
    }
});

//全选
$("#checkall").click(function(){
    var isChecked = $(this).prop("checked");
    $(".check").prop("checked", isChecked);
});

//单个审核的传值
$(".check_status").click(function(){
    var str = $('.check').val();
    location.href="{{URL('check')}}?u_id="+str;
});
</script>