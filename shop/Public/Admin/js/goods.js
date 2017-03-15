$(function(){
	
	// 日期中文字符
  var dateFormat = {
	 dateFormat: "yy-mm-dd"
		 ,monthNames: [ "一月", "二月", "三月", "四月", "五月", "六月", "七月", 
	" 八月 ", " 九月 ", "十月 ", " 十一月 ", "十二月 " ]
		,dayNamesMin: [ "日 ", " 一 ", "二 ", " 三 ", "四 ", " 五 ", " 六 " ]
	};
	// 为 ID 为 begin_time的 input 设置日历
	 $("#begin_time").datepicker(dateFormat);
	 $("#end_time").datepicker(dateFormat);
})
