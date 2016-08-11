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
            <h4>学院管理>>班级列表</h4>
        </div>
        <div class="right container">
            <div class="custom-info">
                <div class="info-box">
                    <a class="btn03" href="{{URL('add_class')}}">新增班级</a>
                    <ul class="ul-datetime">
                        <form action="{{URL('findban')}}" method="post">
                        <li>
                            <label>学院名称：</label>

                            <select name="c_id">
                                <option value="0">--请选择--</option>
                                @foreach($college as $v)
                                    @if($v->c_id == $check)
                                        <option value="<?=$v->c_id?>" selected="selected"><?=$v->c_name?></option>
                                    @else
                                        <option value="<?=$v->c_id?>"><?=$v->c_name?></option>
                                    @endif
                                @endforeach
                            </select>

                        </li>
                            {{--<input type="submit" value="查询" class="btn01"/>--}}
                        {{--<li><a class="btn01" onclick="seach()">查询</a></li>--}}
                        </form>
                    </ul>
                </div>
            </div>
            <!--detail start-->
            <div class="co-detail clearfix">
                <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
                    <thead id="option">
                    <tr>
                        <th>班级名称</th>
                        <th>所在学院</th>
                        </tr>
                    </thead>
                    @foreach($result as $val)
                        <tbody>
                        <tr>
                            <td><?php echo $val->cla_name?></td>
                            <td><?php echo $val->c_name?></td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
                <!--分页 start-->
                <div class="pages">
                    {!! $result->appends(['c_id'=>$check])->render() !!}
                </div>
                <!--分页 end-->
            </div>
            <!--detail end-->
        </div>
    </div>
</div>

</div>
</body>
</html>


