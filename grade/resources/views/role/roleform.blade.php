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
        <div class="title"><h4>权限管理>>分配权限</h4></div>
        <div class="fill-info">
            <div class="right">
                <a class="btn03" id="xg_btn" href="javascript:;">添加角色</a>
                <div class="info-box">
                    <ul>
                        <li>
                            <label>角色名称：</label>
                            <input type="text" id="r_name"/>
                        </li>
                        <li>
                            <label>描    述：</label>
                            <input type="text" id="r_desc"/>
                        </li>
                        <li>
                            <label>请选择权限：</label>
                            <div class="box">
                                @foreach($priv_arr as $priv)
                                <dl class="dl_box">
                                    <dt><label><input type="checkbox" onclick='funsd("{{$priv['action_code']}}")' id="{{$priv['action_code']}}"/>{{$priv['au_name']}}</dt>
                                    <dd>
                                        @foreach($priv['priv'] as $priv_list=>$list)
                                        <span><label><input type="checkbox" name="name[]"  value="{{$list['action_code']}}" clavalue="{{$priv_list}}" class="{{$priv['action_code']}}"/> {{$list['au_name']}}</label></span>
                                        @endforeach
                                    </dd>
                                </dl>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
                <input type="checkbox" id="all"/>全选/全不选
                <div class="preview"> <input class="preview-btn btn01"  type="button" value="保存" onclick="submit()"> <a class="cancel-btn btn01">取消</a></div>
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
            url: "addrole",
            data: "r_name="+r_name+"&r_desc="+r_desc+"&check_val="+check_val,
            success: function(msg){
                if(msg==1){
                    alert('管理员添加成功');
                    location.href="{{URL('admin_list_role')}}";
                }else{
                    alert("添加失败");
                }

            }
        });
    }
</script>
