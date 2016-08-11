<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
	</head>
	<style type="text/css">
		#box1 .stuName tr td{
			width: 95px;
			height: 20px;
			text-align: center;
		}
        #box1 .chengcai tr td{
            width: 66px;
            height: 20px;
        }
		#box1 .stuXx tr td{
			width: 95px;
			text-align: center;
		}
		#box1 table{
            height: auto;
			float: left;
            height: 306px;
            background: yellowgreen;
		}
        body {
            margin: 0;
            padding: 0;
            width: 6000px;
            height: auto;
        }
        #box2{
            float: left;
            width: 6000px;
            height: 260px;
        }
        #box2 table{
            float: left;
        }
        #box2 .stuName tr td{
            width: 95px;
            height: 20px;
        }
        #box2 .score tr td{
            width: 66px;
            height: 20px;
            /*text-align: center;*/
        }
	</style>
	<body>
		<div id="box1">
			<table border="1" style="text-align: center;" class="stuXx">
				<tr>
					<td rowspan="10">小组号</td>
					<td rowspan="10" style="width: 140px;">本门课程重修次数</td>
					<td style="width: 130px;">日期(星期)</td>
				</tr>
				<tr>
					<td>请假\旷课\休学</td>
				</tr>
				<tr>
					<td>作弊</td>
				</tr>
				<tr>
					<td>不及格</td>
				</tr>
				<tr>
					<td>成才人数</td>
				</tr>
				<tr>
					<td>班级人数</td>
				</tr>
				<tr>
					<td>成材率</td>
				</tr>
				<tr>
					<td>出勤人数</td>
				</tr>
				<tr>
					<td>出勤率</td>
				</tr>
				<tr>
					<td>姓名</td>
				</tr>
			</table>
            @foreach($array_date as $k=>$v)
                <table border='1' class="chengcai">
                    <tr>
                        <td colspan="2">{{$k}}({{$v['week']}})</td>
                    </tr>
                    <tr>
                        <td colspan="2">0</td>
                    </tr>
                    <tr>
                        <td colspan="2">0</td>
                    </tr>
                    <tr>
                        <td colspan="2">34</td>
                    </tr>
                    <tr>
                        <td colspan="2">10</td>
                    </tr>
                    <tr>
                        <td colspan="2">44</td>
                    </tr>
                    <tr>
                        <td colspan="2">22.7%	</td>
                    </tr>
                    <tr>
                        <td colspan="2">44</td>
                    </tr>
                    <tr>
                        <td colspan="2">100.0%	</td>
                    </tr>
                    <tr   rowspan='2'>
                        <td>笔试</td>
                        <td>机试</td>
                    </tr>
                </table>
            @endforeach
		</div>
        @foreach($grades as $key => $val)
		<div id="box2" >
            <div style=" text-align:center; line-height: 200px; width: 96px; height:260px;background:#add8e6;border: solid 2px;float: left;">
                第{{$key}}组
            </div>
            <div style=" text-align:center; width: 5460px; height:260px;border: solid 2px;float: left;background: #add8e6">
                @foreach($val as $keys => $vals)
                    <table style=" width: 143px;height: 44px;background: rosybrown" border="1">
                        <tr>
                            <td>0</td>
                        </tr>
                    </table>
                    <table style="width: 140px; height: 44px;float: left;background: chartreuse" border="1">
                        <tr >
                            <td>{{$keys}}</td>
                        </tr>
                    </table>
                        @foreach($vals as $keyss => $valss)
                                <table style="width: 148px; height: 44px;float: left" border="1">
                                <tr >
                                    <td style="background: #add8e6" width="72px">{{$valss['li']}}</td>
                                    <td style="background: navajowhite" width="72px">{{$valss['ji']}}</td>
                                </tr>
                                </table>
                    @endforeach
                    <br><br>
                @endforeach
            </div>
            </div>
            @endforeach
	</body>
</html>
