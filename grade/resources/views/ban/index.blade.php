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
            <div class="info-box">
                <ul>
                    <li>
                        <label>请选择学院：</label>
                        <input type="password" name="name" class="w200 name" value="" id="pwdss" >
                    </li>
                    <li>
                        <label>请选择班级：</label>
                        <input type="password" name="name" class="w200 name" value="" id="userpwd" >
                    </li>

                </ul>
            </div>
            <div class="preview"> <a class="preview-btn btn01" onclick="pwd()">保存</a> <a class="cancel-btn btn01">取消</a> </div>
        </div>
    </div>
</div>
</body>
</html>
{{--<script src="{{URL('public/assets')}}/js/jquery.js"></script>--}}
{{--<script>--}}
    {{--//验证密码--}}
    {{--function pwd(){--}}
        {{--var pwdss = $('#pwdss').val();--}}
        {{--var userpwds = $('#userpwds').val();--}}
        {{--var userpwd=$("#userpwd").val();--}}
        {{--if(userpwd!=userpwds)--}}
        {{--{--}}
            {{--alert('俩次密码不一致');--}}
            {{--return false;--}}
        {{--}--}}
        {{--$.ajax({--}}
            {{--type: "POST",--}}
            {{--url: "{{URl('Password/update')}}",--}}
            {{--data: "pwdss="+pwdss+"&userpwd="+userpwd,--}}
            {{--success: function(msg){--}}
                {{--//alert(msg);--}}
                {{--if(msg == 1){--}}
                    {{--location.href="{{URL('quit')}}";--}}
                {{--}else if(msg == 2){--}}
                    {{--alert('原密码输入有误。');--}}
                {{--}else{--}}
                    {{--alert('修改密码失败,请重新修改');--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}



    {{--}--}}


{{--</script>--}}
