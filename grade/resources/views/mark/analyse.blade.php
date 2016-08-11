<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>班级列表</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
    <script type="text/javascript" src="{{url('public/assets')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{url('public/assets')}}/js/js.js"></script>
    <script src="{{url('public/assets')}}/js/highcharts.js"></script>
    <script src="{{url('public/assets')}}/js/exporting.js"></script>
</head>

<body>
<div class="chuda_co" id="container">
    <div>
        <?=$data['mark']?>
    </div>
    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
</div>
</body>
</html>

<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: "<?=$data['cla_name']?>班 周考成绩饼状图"
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: "百分比",
            colorByPoint: true,
            data: [{
                name: "及格率",
                y: <?=$data['qualified'];?>
            }, {
                name: "未及格率",
                y: <?=$data['off-grade'];?>
            }]
        }]
    });
});
</script>