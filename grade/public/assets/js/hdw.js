// JavaScript Document
$(document).ready(function(){
	var g_id = $('.group').val();
	$.get('groupnum',{g_id:g_id},function(msg){
		$('#num').html(msg);
	})
	/*点击右移*/
	$("#add").click(function(){
		var num = $('#num').html();
		if($("#select1 option:selected").length+$("#select2 option").length>num){
			alert("最多可以添加"+num+"个人");
		}else{
			$("#select1 option:selected").appendTo("#select2");
		}
	});
	/*点击左移*/
	$("#remove").click(function(){
		$("#select2 option").css('color','black').removeAttr('leader');
		$("#select2 option:selected").appendTo("#select1");

		});
	/*点击保存*/
	$("#save").click(function(){
		var g_id = $('.group').val();
		var num = $('#num').html();
		var option = $('#select2').find('option');
		for(i=0;i<option.length;i++){
			if(option.eq(i).attr('leader') == '1'){
				var leader_id = option.eq(i).val();
			}
		}
		if(num == 0 ){
			alert("本组成员已满,换个别的小组添加吧");return false;
		}
		if($("#select2 option:selected").length<1){
			alert("请添加小组成员");return false;
		}

		for(i=0;i<option.length;i++){
			if(num != 6){

			}else if(option.eq(i).attr('leader') == '0'){
				alert("请指定小组长");return false;
			}
		}

		var str = "";
		$("#select2 option").each(function(){
			str += ","+$(this).val();
		})
		str = str.substr(1);
		location.href = "groupAdd?u_id="+str+"&g_id="+g_id+"&leader_id="+leader_id;
	})
	/*小组改变事件*/
	$('.group').change(function(){
		var g_id = $(this).val();
		$.get('groupnum',{g_id:g_id},function(msg){
			$('#num').html(msg);
		})
	})
	/*指定组长*/
	$('#assign').click(function(){
		var g_id = $('.group').val();
		var num = $('#num').html();
		$.get('hasleader',{g_id:g_id},function(msg){
			if(msg == 1){
				alert("本组已经有组长了");
				return false;
			}else if($("#select2 option:selected").length>1){
				alert("只能指定一人为组长");return false;
			}
			$("#select2 option").css('color','black').removeAttr('leader');
			$("#select2 option:selected").css('color','red').attr('leader','1');
		});

	})

});