<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wopop</title>

    <link href="{{url('public/assets')}}/css/style.css" rel="stylesheet" type="text/css">

</head>

<body class="login">
<div class="login_logo"><img src="{{url('public/assets')}}/images/logo.png"></div>
<div class="login_m">

    <div class="login_boder">
        <div class="login_padding">
            <form action="{{URL('Login/power')}}" method="post" onsubmit="return checkall(this)">
            <h2>用户名</h2>
            <label>
                <input type="text" id="username" name="username" class="txt_input txt_input2" onfocus="if (value ==&#39;Your name&#39;){value =&#39;&#39;}" onblur="uname()" value="Your name">
            </label>
            <h2>密码</h2>
            <label>
                <input type="password" name="textfield2" id="userpwd" class="txt_input" onfocus="if (value ==&#39;******&#39;){value =&#39;&#39;}" onblur="pwd()" value="******">
            </label>
            {{--<h2>验证码</h2>--}}
            {{--<label>--}}
                {{--<input type="text" id="yzm" class="txt_input3" onfocus="if (value ==&#39;******&#39;){value =&#39;&#39;}" onblur="if (value ==&#39;&#39;){value=&#39;******&#39;}" value="******"><img src="{{url('public/assets')}}/images/YZM.png" width="100" height="30" style=" vertical-align:middle" />--}}
            {{--</label><br/>--}}
            <span id="judge"></span>
            <div class="rem_sub">
                <label>
                    <input type="submit" class="sub_button" name="button" id="button" value="登录" style="opacity: 0.7;">
                </label>
            </div>
            </form>
        </div>
    </div><!--login_boder end-->
</div><!--login_m end-->
</body>
</html>
<script src="{{URL('public')}}/jquery-2.1.4.min.js"></script>
<script>
        //验证账号
        function uname(){
            name=$("#username").val();
            //reg=/^\d{12}$/;
            if(name==""){
                $('#judge').html("<font color='red'>账号不能为空</font>");
                return false;
            }else if(!reg.test(name)){
                $('#judge').html("<font color='red'>账号必须为12位学号</font>");
                return false;
            }else{
                return true;
            }
        }
        //验证密码
        function pwd(){
            pwds=$("#userpwd").val();
            //reg=/^[a-zA-Z0-9!"\#$%&'()*+,-./:;<=>?@\[\\\]^_`\{\|\}\~]{6,16}$/;
            if(pwds==""){
                $('#judge').html("<font color='red'>密码不能为空</font>");
                return false;
            }else {
                //$('#judge').html("<font color='red'>密码为6-16位</font>");
                return true;
            }
        }
    //提交时验证
    function checkall(){
       if(uname()==true & pwd()==true ){
            return true;
       }else{
           return false;
       }
    }
</script>
