$(function(){
/*日历*/
$('.form_date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  0,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
});
/*开始日期-截止日期
$('.form_date').datetimepicker('setStartDate', '2015-01-01');
var myDate = new Date();
$('.form_date').datetimepicker('setEndDate', myDate.getFullYear()+'-'+(parseInt(myDate.getMonth())+2)+'-'+(parseInt(myDate.getDate())));
*/
});