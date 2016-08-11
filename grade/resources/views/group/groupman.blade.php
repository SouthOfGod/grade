<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>班级列表</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/assets')}}/css/erweima-style.css" />
    <script type="text/javascript" src="{{url('public/assets')}}/js/jquery.js"></script>
    <script type="text/javascript" src="{{url('public/assets')}}/js/js.js"></script>
</head>

<body>
<div class="chuda_co" id="container">
    <div class="co-box">
        <div class="title">
            <h4>小组管理>>分配PK小组</h4>
        </div>
        <form action="{{url('group/pkadd')}}" method="post" >
        <div class="right">
            <ul>
                <li>
                    <label>学院：</label>
                    <?php foreach($c_name as $k=>$v){?>
                    <?=$v->c_name?>
                    <input type="hidden" name="c_id" value="<?=$v->c_id?>"  />
                    <?php }?>
                </li>
                <li>
                    <label>班级：</label>
                    <?php foreach($c_name as $k=>$v){?>
                    <?=$v->cla_name?>
                    <input type="hidden" name="cla_id" value="<?=$v->cla_id?>"  />
                    <?php }?>
                </li>
                <li>             
                <label>PK小组：</label>
                <select name="pk1" id="pk1">
                    <option value="0">--请选择--</option>
                    <?php foreach ($group as $k => $v){?>
                        <?php if ($v->g_id%2==1&& empty($v->curr)){ ?>
                            <option value="<?=$v->g_id?>"><?=$v->g_name?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                 VS 
                <select name="pk2" id="pk2">
                    <option value="0">--请选择--</option>
                    <?php foreach ($group as $k => $v){?>
                        <?php if ($v->g_id%2==0 && empty($v->curr)){ ?>
                            <option value="<?=$v->g_id?>"><?=$v->g_name?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <span id='err'></span>
                </li>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="preview"> <input type="submit" class="preview-btn btn01" value="保存" /> <input type="reset" class="cancel-btn btn01" value="取消" /></div>
            </ul>
        </div>
        </form>
    </div>
</div>
</body>
</html>
<script>
$('#pk1').change(function(){
    var pk1 = $(this).val();
    if(pk1==0){
        $('#err').html("<font color='red'>*必须选择</font>");
    }
})
$('#pk2').change(function(){
    var pk2 = $(this).val();
    if(pk2==0){
        $('#err').html("<font color='red'>*必须选择</font>");
    }else{
        $('#err').html("");
    }
})
</script>