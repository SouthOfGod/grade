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
      <h4>小组管理>>pk组</h4>
    </div>
    <div class="right"> 
    	<a class="btn03" href="javascript:;">新增角色</a>
      <!--detail start-->
      <div class="co-detail clearfix"> 
        <table class="tablelist" border="0" cellpadding="0" cellspacing="0">
            <thead>
              <tr>
                <th>编号</th>
                <th>学院</th>
                <th>班级</th>
                <th>小组</th>
                <th>小组</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pk as $k => $v){ ?>
              <tr>
                <td><?=$v->p_id?></td>
                <td><?=$v->c_name?></td>
                <td><?=$v->cla_name?></td>
                <td><?=$v->g_name?></td>
                <td><?=$v->pk2?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          
      </div>
      <!--detail end--> 
    </div>
  </div>
</div>
</body>
</html>
