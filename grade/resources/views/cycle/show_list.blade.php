<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>周期列表</title>
</head>
<body>

     选择周期：
  <select id="frequency">
      <?php foreach($arr as $key => $value){ ?>
          <option value="<?php echo $value?>"><?php echo $value?></option>
      <?php } ?>
  <input type="submit" value='确定' id='count'/>
  </select>

  <div id='option'></div>
</body>
</html>
<script type="text/javascript" src="{{url('public/assets')}}/js/jquery-1.5.1.js"></script>
<script>
    $('#count').click(function(){
        var frequency=$('#frequency').val();
        var str='';
        $.ajax({
            type:'post',
            data:'id='+frequency,
            dataType:"json",
            url:'{{URL('Cycle/ex_list')}}',
            success:function(msg){
                var length = msg.length;
               alert(msg);
                for(var i=0;i<length;i++){
                    str +='<table border=1>';
                    str +='<tr>';
                    str +='<td>';
                    str +='日期';
                    str +='</td>';
                    str +='<td>';
                    str +='类型';
                    str +='</td>';
                    str +='<td>';
                    str +='星期';
                    str +='</td>';
                    str +='</tr>';
                    for(var i=0;i<length;i++){
                    str +='<tr>';
                    str +='<td>';
                    str +=msg[i];
                    str +='</td>';
                    str +='<td>';
                    str +=msg[i].type;
                    str +='</td>';
                    str +='<td>';
                    str +=msg[i].week;
                    str +='</td>';
                    str +='</tr>';
                    }
                    str +='</table>';
                }
                $('#option').html(str);
            }
        })
    })
</script>