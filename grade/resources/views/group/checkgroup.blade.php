<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>班级列表</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
    <script type="text/javascript" src="{{url('public/assets')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{url('public/assets')}}/js/js.js"></script>
    <style type="text/css">
        *{margin:0;padding:0;list-style-type:none;}
        a,img{border:0;}
        body{background:#e3e3e3;height:100%;font:normal normal 12px/24px "Microsoft yahei", Arial;padding-bottom:30px;}
        a{color:#333;text-decoration:none;}
        a:hover{color:#093;text-decoration:none;}
        #title{width:300px;margin:3% auto 0;}
        #title h2{font-size:18px;}
        d
        h3{color:#333;font-size:14px;text-align:center;margin:20px 0;}
        /* box */
        .box{width:400px;margin:10px auto 0;background:#fff;border:1px solid #d3d3d3;}
        .tab_menu{overflow:hidden;}
        .tab_menu li{width:100px;float:left;height:30px;line-height:30px;color:#fff;background:dodgerblue;text-align:center;cursor:pointer;}
        .tab_menu li.current{color:#333;background:#fff;}
        .tab_menu li a{color:#fff;text-decoration:none;}
        .tab_menu li.current a{color:#333;}
        .tab_box{padding:20px;}
        .tab_box li{height:24px;line-height:24px;overflow:hidden;}
        .tab_box li span{margin:0 5px 0 0;font-family:"宋体";font-size:12px;font-weight:400;color:#ddd;}
        .tab_box .hide{display:none;}}
    </style>
</head>

<body>
<div class="chuda_co" id="container">
    <div class="co-box">
        <div class="title">
            <h4>小组管理>>查看小组</h4>
        </div>
        <div class="box demo2" style="width: 90%">
            <ul class="tab_menu">
                @for($i=1;$i<=$groupRow;$i++)
                    <li>{{$i}}组</li>
                @endfor
            </ul>
            <div class="tab_box">
                <div>
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($info1))
                                @foreach($info1 as $k=>$v)
                                    <tr>
                                        <td>{{$v->u_name}}</td>
                                        <td>
                                            @if($v->u_position == 1)
                                                组长
                                                @elseif($v->u_position == 0)
                                                组员
                                            @endif
                                        </td>
                                        <td>{{$v->cla_name}}</td>
                                        <td>{{$v->c_name}}</td>
                                        <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info2))
                            @foreach($info2 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info3))
                            @foreach($info3 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info4))
                            @foreach($info4 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info5))
                            @foreach($info5 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info6))
                            @foreach($info6 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info7))
                            @foreach($info7 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info8))
                            @foreach($info8 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info9))
                            @foreach($info9 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info10))
                            @foreach($info10 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info11))
                            @foreach($info11 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="hide">
                    <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>小组</th>
                            <th>班级</th>
                            <th>学院</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($info12))
                            @foreach($info12 as $k=>$v)
                                <tr>
                                    <td>{{$v->u_name}}</td>
                                    <td>
                                        @if($v->u_position == 1)
                                            组长
                                        @elseif($v->u_position == 0)
                                            组员
                                        @endif
                                    </td>
                                    <td>{{$v->cla_name}}</td>
                                    <td>{{$v->c_name}}</td>
                                    <td><a href="groupdel?u_id={{$v->u_id}}">移出本组</a></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--demo2 end-->
        <script type="text/javascript" src="{{url('public/assets')}}/js/jquery-1.4.2.min.js"></script>
        <script src="{{url('public/assets')}}/js/jquery.tabs.js"></script>
        <script src="{{url('public/assets')}}/js/jquery.lazyload.js"></script>
        <script type="text/javascript">
            $(function(){
                $('.tab_menu li').eq(0).attr('class','current');

                $("img[original]").lazyload({ placeholder:"images/color3.gif" });

                $('.demo1').Tabs();
                $('.demo2').Tabs({
                    event:'click'
                });
                $('.demo3').Tabs({
                    timeout:300
                });
                $('.demo4').Tabs({
                    auto:3000
                });
                $('.demo5').Tabs({
                    event:'click',
                    callback:lazyloadForPart
                });
                //部分区域图片延迟加载
                function lazyloadForPart(container) {
                    container.find('img').each(function () {
                        var original = $(this).attr("original");
                        if (original) {
                            $(this).attr('src', original).removeAttr('original');
                        }
                    });
                }
            });
        </script>
    </div>
</div>

</body>
</html>
