<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>登陆后主页面</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
</head>

<body>
<div class="chuda_co" id="container">
    <div class="title">
        <h4>首页</h4>
    </div>
    <div class="right">
        <div class="welinfo">
            {{--<span><img src="{{url('public/assets')}}/images/sun.png" alt="天气"></span>--}}
            <span class="username"></span>
            <b style="font-size: 20px">
                <?php date_default_timezone_set("Asia/Shanghai");//地区?>
                <font style="color: #4dff36"> <?php  echo Session::get('u_name')?></font>
                <?php
                if(0<date('H') && date('H')<11){
                    echo "早上好";
                }elseif(11<date('H') && date('H')<13){
                    echo "中午好";
                }elseif(13<date('H') && date('H')<17){
                    echo "下午好";
                }else{
                    echo "晚上好";
                }
                ?>，欢迎登陆八维成绩管理系统
            </b>
            {{--<a href="#">帐号设置</a>--}}
        </div>
        <div class="welinfo">
            {{--<span><img src="{{url('public/assets')}}/images/time.png" alt="时间"></span>--}}
            {{--<i>您上次登录的时间：2013-10-09 15:22</i> （不是您登录的？<a href="#">请点这里</a>）--}}
        </div>
		<div class="tj_box"><img src="{{URL('public/assets')}}/images/bawei.jpg" alt="网络太不给力了..." style="width: 100%;height: auto"/></div>
    </div>
</div>
</body>
</html>
