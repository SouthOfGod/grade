<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>左侧菜单</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
    <script type="text/javascript" src="{{url('public/assets')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{url('public/assets')}}/js/js.js"></script>
</head>
<body>
<div class="left_slide_nav">
    <div class="business">
        @foreach($action_list as $key => $val )
        <dl class="dl_list">
            <dt class="dl_open"><span class="expend_icon"></span><a href="javascript:;">{{$val['label']}}</a></dt><!--打开状态替换close为open-->
            @foreach($val['children'] as $keys => $vals)
            <dd><a href='{{URL("$vals[action]")}}' target="rightFrame">{{$vals['label']}}</a></dd>
            @endforeach
            <!--当前页面导航条dl添加class为dl_height,dt添加class为dl_open,dd添加class为dd_current-->
        </dl>
        @endforeach
        <dl class="dl_list dl_3">
            <dt class="dl_open"><span class="expend_icon"></span><a href="javascript:;">密码管理</a></dt><!--打开状态替换close为open-->
            <dd><a href="{{URL('Password/index')}}" target="rightFrame">修改密码</a></dd>
        </dl>
    </div>
</div>
</body>
</html>
