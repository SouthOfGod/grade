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
        <div class="title"><h4>权限管理>>新增角色</h4></div>
        <form method="post" action="{{url('Administr/add')}}" enctype="multipart/form-data">
                <h3>导入Excel表：</h3>
            <input type="file" name='file_stu'>
                <input type="submit"  value="导入" />
        </form>
        <div class="fill-info">
            <div class="right">
                <a class="btn02" id="xg_btn" href="{{URL('admin_list')}}">角色列表</a>
                <form action="{{URL('insertadmin')}}" method="post">
                <table cellspacing='1' id="list-table">
                    <tr>
                        <td>用户名称:</td>
                        <td><input type="text" name="u_name"/></td>
                    </tr>
                    <tr>
                        <td>密   码：</td>
                        <td><input type="password" name="u_pwd"/></td>
                    </tr>
                    <tr>
                        <td>确  认  密   码：</td>
                        <td><input type="password" name="afm_pwd"/></td>
                    </tr>
                    <tr>
                        <td>角色选择</td>
                        <td>
                        <select name="role" id="role">
                            @foreach($role as $key => $val)
                            <option value="{{$val->action_list}}">{{$val->role_name}}</option>
                            @endforeach
                        </select>
                        </td>
                    </tr>
                </table>
                <div class="preview"> <input class="preview-btn btn01"  type="button" value="保存" onclick="submit()"> <a class="cancel-btn btn01">取消</a> </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="{{URL('public')}}/jquery-2.1.4.min.js"></script>
<script>
    $("#all").click(function(){
        var isChecked = $(this).prop("checked");
        $(":checkbox").prop("checked", isChecked);
    });
    function  funsd(obj){
        var isChecked = $("#"+obj).prop("checked");
        $("."+obj).prop("checked", isChecked);
    }
    //提交
    function submit(){
        var obj=document.getElementsByName("name[]");
        check_val = [];
        for(k in obj){
            if(obj[k].checked)
                check_val.push(obj[k].value);
        }
        r_name=$("#r_name").val();
        r_desc=$("#r_desc").val();
        $.ajax({
            type: "POST",
            url: "addpower",
            data: "r_name="+r_name+"&r_desc="+r_desc+"&check_val="+check_val,
            success: function(msg){
                if(msg==1){
                    alert('管理员添加成功');
                    location.href="{{URL('adminlist')}}";
                }else{
                    alert("添加失败");
                  }

            }
        });
    }
</script>
