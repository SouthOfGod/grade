<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>班级列表</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="{{url('public/assets')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{url('public/assets')}}/js/js.js"></script>
</head>

<body>
<div class="chuda_co" id="container">
    <div class="co-box">
        <div class="title">
            <h4>权限管理>>角色列表</h4>
        </div>
        <div class="right container">
            <div class="custom-info">
                <div class="info-box">
                    <ul class="ul-datetime">
                        <li>
                            <label>角色名称：</label>
                            <input type="text" class="w100">
                        </li>
                        <li><a class="btn01" onclick="seach()">查询</a></li><a class="btn03" href="{{URL('admin_add_role')}}">新增角色</a>{{--<a class="btn02" href="">批量删除</a>--}}
                    </ul>
                </div>
            </div>
            <!--detail start-->
            <div class="co-detail clearfix">
                <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                    <thead>
                    <tr id="option">
                        {{--<th>请选择</th>--}}
                        <th>角色名称</th>
                        <th>角色描述</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    @foreach($rolelist as $val)
                    <tbody>
                    <tr >
                        {{--<td><input type="checkbox" name="" /></td>--}}
                        <td><?php echo $val->role_name?></td>
                        <td><?php echo $val->role_describe?></td>
                        {{--<a class="edit">锁定</a>--}}
                        <td class="operation"><a  class="dell" id="{{$val->role_id}}"><i class="fa fa-trash-o fa-lg"></i></a></td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>
                <!--分页 start-->
                <div class="pages">
                    <div class="pages-btn">
                        {!! $rolelist->render() !!}
                    </div>
                </div>
                <!--分页 end-->
            </div>
            <!--detail end-->
        </div>
    </div>
</div>
<div class="pop_layer add-mess">
    <div class="fill-info pop-layer-box">
        <h3 class="title-big">修改班级信息</h3><a class="pop-close">X</a>
        <div class="info-box">
            <ul>
                <li>
                    <label>班级名称：</label>
                    <input type="text" name="name" class="w200 name" value="">
                </li>
                <li>
                    <label>班主任：</label>
                    <select class="w200">
                        <option>于强</option>
                        <option>张三</option>
                    </select>
                </li>
                <li>
                    <label>讲师：</label>
                    <select class="w200">
                        <option>李朋</option>
                        <option>王五</option>
                    </select>
                </li>
            </ul>
        </div>
        <div class="preview"> <a class="preview-btn btn01">保存</a> <a class="cancel-btn btn01">取消</a> </div>
    </div>
</div>
</body>
</html>
<script>
    $('.dell').click(function(){
        this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);
        var id =this.id;
       // alert(id)
        $.ajax({
        type: "POST",
        url: "{{URL('dellrole')}}",
        data: "id="+id,
        datatype:'text',
        success: function(msg){
            if(msg==1){
            alert('删除成功');
            }else{
            alert('删除失败,请联系管理员');
            }
        }
        });
    })
    //根据 用户名查询
    function seach(){
        var u_name=$('.w100').val();
        var str="";
        $.ajax({
        type: "POST",
        url: "{{URL('findrole')}}",
        data: "u_name="+u_name,
        dataType:"json",
        success: function(msg){
           var len = msg.length;
            //alert(length)
            for(var i=0;i<len;i++){
                str+='<tr>';
                str+='<td>';
                str+= msg[i].role_name;
                str+='</td>';
                str+='<td>';
                str+=msg[i].role_describe;
                str+='</td>';
                str+='<td class="operation">';
                str+='<a  class="dell" id="'+msg[i].role_id+'">';
                str+='<i class="fa fa-trash-o fa-lg">';
                str+='</i>';
                str+='</a>';
                str+='</td>';
                str+='</tr>';
             }
                $('tr:gt(0)').remove();
                $('#option').after(str);
            }
        });
    }
</script>