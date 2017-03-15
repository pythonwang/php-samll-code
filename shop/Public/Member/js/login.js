$(function() {
	
	//点击刷新验证码
	//var verifyUrl = $('#verify-img').attr('src');
	//$('#verify-img').click(function () {
	//	$(this).attr('src', verifyUrl + '?' + Math.random());
	//});

	//jQuery Validate 表单验证
	
	/**
	 * 添加验证方法
	 * 以字母开头，5-17 字母、数字、下划线"_"
	 */
	 jQuery.validator.addMethod("user",function(value,element) {
	 	var tel= /^[a-zA-Z][\w]{4,16}$/;
	 	return this.optional(element)||(tel.test(value));
	 },"");
	$('form[name=login]').validate({
		errorElement : 'span',
		success : function(label) {
			label.addClass('success');
		},
		rules : {
			account : {
				required : true,
			    user : true,
			    
		},
		password : {
			required : true,
			user : true
		}
		
	},
	messages : {
		account :{
		    required : '',
		
	},
	password : {
		required : ''
	
	}
}



	
});
});