<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>教学周期</title>
</head>
<body>    

<table border="1" > 
    <input type="hidden" value='{{$cy_id}}' id="hd" />     
    <tr>
        <td>日期</td>
        <td>星期</td>
        <td>类型</td>
    </tr>      
    <?php foreach ($date as $k=>$v){ ?>        
    <tr>
        <td class='aaa'><?php echo $v['aa']?></td>
        <td><?php echo $v['bb']?></td> 
        <td>
            <input type="radio" name="type_<?=$k?>" value="日考" class='type' checked=checked/>日考
            <input type="radio" name="type_<?=$k?>" value="周考" class='type'/>周考
            <input type="radio" name="type_<?=$k?>" value="月考" class='type'/>月考
            <input type="radio" name="type_<?=$k?>" value="补考" class='type'/>补考
        </td>
    </tr> 
    <?php }?>
    <tr>
        <td><input type="button" value='提交' id="bt" /></td>
    </tr>     
</table>

</body>
</html>
<script src="{{URL('public/assets')}}/js/jquery.js"></script>
<script>
    $(function(){
        var hidden = $('#hd').val();
        $('#bt').click(function(){
            var len = $('.aaa').length;
            var arr = [];
            var arr1 = [];
            for(i=0;i<len;i++){
                arr[i] = $('.aaa').eq(i).html();

            }
            for(i=0;i<len;i++){
                arr1[i] = $('.type:checked').eq(i).val();
            }
            $.ajax({
                type:'post',
                url:'{{URL('Cycle/insert')}}',
                data:{
                    arr:arr,
                    arr1:arr1,
                    hidden:hidden
                },
                success:function(msg){
                    alert(msg);
                    if(msg==1){
                        alert('修改成功！');location.href="{{URL('up_cycle')}}";
                    }
                }
            })
        })
 
    })
</script>


