<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>简单实用蓝色jQuery日期选择插件 - huiyi8素材</title>
<link href="{{url('public/assets')}}/css/lyz.calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{url('public/assets')}}/js/jquery-1.5.1.js"></script>
<script src="{{url('public/assets')}}/js/lyz.calendar.min.js" type="text/javascript"></script>
<style>
body {
font-size: 12px;
font-family: "微软雅黑", "宋体", "Arial Narrow";
}
</style>
<script>
    $(function () {
        $("#txtBeginDate").calendar();
        $("#txtEndDate").calendar();
        /*教学周期添加*/
        $('#cycle').click(function(){
            var start_cycle = $('#txtBeginDate').val();
            var end_cycle = $('#txtEndDate').val();
            var frequency = $('#frequency').val();
            $.ajax({
                type:'post',
                data:'start_cycle='+start_cycle+'&end_cycle='+end_cycle+'&frequency='+frequency,
                url:'{{URL('Cycle/add')}}',
                success:function(msg){
                    //alert(msg);
                    if(msg==1){
                        alert('修改成功');location.href='{{URL('Cycle/date_list')}}';
                    }else if(msg==0){
                        alert('请选择日期');
                    }else if(msg==2){
                        alert('日期没有改变,瞎点');
                    }
                }
            })
        })
    });

</script>
</head>

<body>

<div>
<ul>
<li>  选择周期：
  <select id="frequency">
  <?php foreach($arr as $key => $value){ ?>
      <option value="<?php echo $value?>"><?php echo $value?></option>
  <?php } ?>
  </select></li>
<li>开始：<input id="txtBeginDate" style="width:170px;padding:7px 10px;border:1px solid #ccc;margin-right:10px;"/></li>
<li> 结束：<input id="txtEndDate" style="width:170px;padding:7px 10px;border:1px solid #ccc;" /> </li>
<li> <input type="button" value="确定" id="cycle" />   </li>
</ul>
</div>

</body>
</html>
