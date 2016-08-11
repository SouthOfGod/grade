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
            <h4>组建管理>>分配PK班</h4>
        </div>
        <div class="right container">
            <div class="custom-info">
                <div class="info-box">
                    <ul class="ul-datetime">
                        <li>
                            <label>选择学院：</label>
                            <select name="" id="checkcollege">
                                <option value="0">--请选择--</option>
                                @foreach($info as $k=>$v)
                                    <option value="{{$v->c_id}}">{{$v->c_name}}</option>
                                @endforeach
                            </select>
                            <span><font id='err' color='red'></font></span>
                        </li>
                    </ul>
                    <!-- <ul class="ul-datetime">
                        <li id="aaa" style="display: none">
                            <label>选择pk班级：</label>
                        </li>
                        <li id="aa" style="display: none">
                            <select name="" id="pk1">

                            </select>
                            <span><font id='err1' color='red'></font></span>
                        </li>
                        <li id="bbb" style="display: none">
                            <font style="color: red;font-size: 20px;">vs</font>
                            <select name="" id="pk2">

                            </select>
                            <span><font id='err2' color='red'></font></span>
                        </li>
                        <li id="ccc" style="display: none">
                            <font style="color: red;font-size: 20px;">vs</font>
                            <select name="" id="pk3">

                            </select>
                            <span><font id='err3' color='red'></font></span>
                        </li>
                    </ul> -->
                    <ul class="ul-datetime">
                        <li><a class="btn01" id="confirm">一键生成</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
// $('#checkcollege').change(function(){
//     $('#aa').hide();
//     $('#aaa').hide();
//     var c_id = $(this).val();
//     if(c_id==0){
//         $('#err').html('*必须选择学院');return;
//     }
//     $('#err').html('');
//     $.ajax({
//         type:'get',
//         url:"allot_pk_grade",
//         data:'c_id='+c_id,
//         success:function(msg){
//             var dat = eval('('+msg+')');
//             if(dat!=""){
//                 var str = '';
//                     str +='<option value="0">--请选择--</option>';
//                 for(var i=0;i<dat.length;i++){
//                     if(dat[i].curr!=1){
//                         str += '<option value="'+dat[i].cla_id+'">'+dat[i].cla_name+'</option>';
//                     }
//                 }    
//                 $('#pk1').html(str);
//                 $('#aa').show();
//                 $('#aaa').show();
//             }
//         }
//     })
// })

// $('#pk1').change(function(){
//     $('#bbb').hide();
//     var cla_id = $(this).val();
//     var c_id = $('#checkcollege').val();
//     if(cla_id==0){
//         $('#err1').html('*必须选择PK班级');
//     }
//     $('#err1').html("");
//     $.ajax({
//         type:'get',
//         url:"{{url('Classs/getstage')}}",
//         data:'cla_id='+cla_id+'&c_id='+c_id,
//         success:function(msg){
//             var dat = eval('('+msg+')');

//             if(dat.msg==0){
//                 var cc = dat.data;
//                 var str = '';
//                     str +='<option value="0">--请选择--</option>';
//                 for(var i=0;i<cc.length;i++){
//                     if(cc[i].curr!=1){
//                         str += '<option value="'+cc[i].cla_id+'">'+cc[i].cla_name+'</option>';
//                     }
//                 }    
//                 $('#pk2').html(str);
//                 $('#bbb').show();
                
//             }
//         }
//     })
// })


// $('#pk2').change(function(){
//     $('#ccc').hide();
//     var cla_id = $(this).val();
//     var c_id = $('#checkcollege').val();
//     var pk1 = $('#pk1').val();
//     if(cla_id==0){
//         $('#err2').html('*必须选择PK班级');
//     }
//     $('#err2').html("");
//     $.ajax({
//         type:'get',
//         url:"{{url('Classs/getstage')}}",
//         data:'cla_id='+cla_id+'&c_id='+c_id+'&pk1='+pk1,
//         success:function(msg){
//             var dat = eval('('+msg+')');

//             if(dat.msg==0){
//                 var cc = dat.data;
//                 var str = '';
//                     str +='<option value="0">--请选择--</option>';
//                 for(var i=0;i<cc.length;i++){
//                     if(cc[i].curr!=1){
//                         str += '<option value="'+cc[i].cla_id+'">'+cc[i].cla_name+'</option>';
//                     }
//                 }    
//                 $('#pk3').html(str);
//                 $('#ccc').show();
                
//             }
//         }
//     })
// })

$('#confirm').click(function(){
    var c_id = $('#checkcollege').val();
    if(c_id==0){
        $('#err').html('*必须选择学院');
    }else{
        $('#err').html("");
        $.ajax({
            type:'get',
            url:"{{url('Classs/pkadd')}}",
            data:'c_id='+c_id,
            success:function(msg){
                var dat = eval('('+msg+')');
                if(dat.err==0){
                    location.href = "{{url('pk_grade_list')}}";
                }else{
                    alert(dat.msg);
                }
            }
        })
    }
})
</script>