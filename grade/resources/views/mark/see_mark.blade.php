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
        <div style="float:left">
        &nbsp;&nbsp;&nbsp;&nbsp;学院 ：
            <select id='search'>
                    <option>请选择学院</option>
                <?php foreach ($res as $v) { ?> 
                    <option value="<?= $v->c_id?>"><?= $v->c_name?></option>
                <?php } ?>  
            </select>
        </div>
        <div style="float:left">
        &nbsp;&nbsp;&nbsp;&nbsp;班级 ：
            <select id="class">
                    <option>请选择班级</option>
                <?php foreach ($ban as $v) { ?> 
                    <option value="<?= $v->cla_id?>"><?= $v->cla_name?></option>
                <?php } ?>  
            </select>
        </div>
        <div style="float:left">
         &nbsp;&nbsp;&nbsp;&nbsp;姓名 ：
            <input type="text" name='name' id='name'/>
        </div>
        <div style="float:left">
        <input type="button" id='psearch' value='搜索' class='preview-btn btn01'/>
        </div>
        
        <div class="right">
            <div class="co-detail clearfix">
                <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                    <thead>
                    <tr id='option'>
                        <th>ID</th>
                        <th>姓名</th>
                        <th>机试成绩</th>
                        <th>理论成绩</th>
                        <th>班级名称</th>
                        <th>学院名称</th>
                        <th>状态</th>
                        <th>添加时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($arr as $v) { ?>            
                    <tr>
                        <td><?= $v->u_id?></td>
                        <td><?= $v->u_name?></td>
                        <td><?= $v->m_machine?></td>
                        <td><?= $v->m_theory?></td>
                        <td><?= $v->cla_name?></td>
                        <td><?= $v->c_name?></td>
                        <td>
                        <?php if($v->m_status==0){?>
                            <font color="red">未审核</font>
                        <?php }else{?>   
                            <font color="green">已审核</font>
                        <?php }?> 
                        </td>
                        <td><?= date('Y-m-d',$v->m_time)?></td>
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
    //搜索
    $('#psearch').click(function(){
        var c_id=$('#search').val();
        if(c_id=='请选择学院')
        {
            alert('请选择学院');
            return false;
        }
        var cla_id=$('#class').val();
        var name=$('#name').val();
        var str="";
        $.ajax({
            type:'post',
            data:'c_id='+c_id+'&cla_id='+cla_id+'&name='+name,
            url:'{{URL('search')}}',
            success:function(msg){
                //alert(msg);
                var data = eval("("+msg+")");
                var len = data.length;
                for(var i=0;i<len;i++){
                    str+='<tr>';
                    str+='<td>';
                    str+=data[i].u_id;
                    str+='</td>';
                    str+='<td>';
                    str+=data[i].u_name;
                    str+='</td>';
                    str+='<td>';
                    str+=data[i].m_machine;
                    str+='</td>';
                    str+='<td>';
                    str+=data[i].m_theory;
                    str+='</td>';
                    str+='<td>';
                    str+=data[i].cla_name;
                    str+='</td>';
                    str+='<td>';
                    str+=data[i].c_name;
                    str+='</td>';
                    if(data[i].m_status==0){
                        str+='<td>';
                        str+="<font color='red'>未审核</font>";
                        str+='</td>';
                    }else{
                        str+='<td>';
                        str+="<font color='green'>已审核</font>";
                        str+='</td>';
                    }
                    str+='<td>';
                    str+= uniux(data[i].m_time);
                    str+='</td>';
                    str+='</tr>';
                }
                $('tr:gt(0)').remove();
                $('#option').after(str);
            }
        })

    })
    function uniux(sj)
    {
        var time = new Date(sj * 1000);
        var ymdhis = "";
        ymdhis += time.getUTCFullYear() + "-";
        ymdhis += (time.getUTCMonth()+1) + "-";
        ymdhis += time.getUTCDate();
        return ymdhis;
    }
</script>


