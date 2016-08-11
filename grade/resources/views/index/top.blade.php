<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>头部</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
</head>

<body>
<div class="wrap">
    <div class="whole-top">
        <p class="name"><img src="{{url('public/assets')}}/images/logo_w.png" />八维成绩管理系统</p>
        <div class="login">
            <!--登录后 start-->
            <div class="login-after">
                <span id="nowTime"></span> &nbsp;
                <a class="exit" href="{{URL('quit')}}" target="_top">退出</a>
            </div>
            <!--登录后 end-->
        </div>
    </div>
</div>
</body>
<?php date_default_timezone_set("Asia/Shanghai");//地区?>
</html>
<script src="{{URL('public')}}/jquery-2.1.4.min.js"></script>
<script type="text/javascript" language="javascript">
    window.onload = function () {
        stime();
    }
    var c = 0;
    var Y =<?php echo date('Y')?>, M =<?php echo date('n')?>, D =<?php echo date('j')?>;
    function stime() {
        c++
        sec = <?php echo time() - strtotime(date("Y-m-d",time()))?>+c;
        H = Math.floor(sec / 3600) % 24
        I = Math.floor(sec / 60) % 60
        S = sec % 60
        if (S < 10) S = '0' + S;
        if (I < 10) I = '0' + I;
        if (H < 10) H = '0' + H;
        if (H == '00' & I == '00' & S == '00') D = D + 1; //日进位
        if (M == 2) { //判断是否为二月份******
            if (Y % 4 == 0 && !Y % 100 == 0 || Y % 400 == 0) { //是闰年(二月有28天)
                if (D == 30) {
                    M += 1;
                    D = 1;
                } //月份进位
            }
            else { //非闰年(二月有29天)
                if (D == 29) {
                    M += 1;
                    D = 1;
                } //月份进位
            }
        }
        else { //不是二月份的月份******
            if (M == 4 || M == 6 || M == 9 || M == 11) { //小月(30天)
                if (D == 31) {
                    M += 1;
                    D = 1;
                } //月份进位
            }
            else { //大月(31天)
                if (D == 32) {
                    M += 1;
                    D = 1;
                } //月份进位
            }
        }
        if (M == 13) {
            Y += 1;
            M = 1;
        } //年份进位
        setTimeout("stime()", 1000);
        $('#nowTime').html(Y + '-' + M + '-' + D + ' ' + H + ':' + I + ':' + S);
        //document.getElementById("nowTime").innerHTML =
    }
</script>
