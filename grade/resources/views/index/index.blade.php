<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}//css/erweima-style.css" />
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/chuda01-style.css" />
</head>

<body>
<iframe width="100%" height="90px" name="main" scrolling="auto" frameborder="0" src="{{URL('Index/top')}}" style="position:fixed;top:0; left:0"></iframe>
<div class="" style=" padding-top:90px">
    <div class="" style="width:18%; float:left; height:1150px;">
        <iframe src="{{URL('Index/left')}}" width="100%" height="100%" name="leftFrame" id="leftFrame" scrolling="No" title="leftFrame"  frameborder="0" framespacing="0" /></iframe>
    </div>
    <div style="float:right; width:82%; height:3000px;" >
        <iframe src="{{URL('Index/right')}}" width="100%" height="100%" name="rightFrame" id="rightFrame" scrolling="No" title="rightFrame" frameborder="0" framespacing="0" /></iframe>
    </div>
</div>
</body>
</html>