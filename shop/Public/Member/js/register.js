$(function () {

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
	 },"以字母开头，5-17 字母、数字、下划线'_'");
	 jQuery.validator.addMethod("em",function(value,element) {
	 	var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/;
	 	return this.optional(element)||(re.test(value));
	 },"邮箱格式错误！");
	$('form[name=register]').validate({
		errorElement : 'span',
		success : function(label) {
			label.addClass('success');
		},
		rules : {
			account : {
				required : true,
			    em : true,
			    remote : {
			    	url : 'checkAccount',
			    	type : 'post',
			    	dataType : 'json',
			    	data : {
			    		account : function() {
			    			return $('#account').val();
			    		}
			    	}
			    }
		},
		password : {
			required : true,
			user : true
		},
		repassword : {
			required : true,
			equalTo : "#password"
		},
		username : {
			required : true,
			rangelength : [2,10],
			remote : {
			    	url : 'checkUsername',
			    	type : 'post',
			    	dataType : 'json',
			    	data : {
			    		username : function() {
			    			return $('#username').val();
			    		}
			    	}
			    }
		},
	
	verify : {
		required : true,
		remote : {
			    	url : 'checkVerify',
			    	type : 'post',
			    	dataType : 'json',
			    	data : {
			    		verify : function() {
			    			return $('#verify').val();
			    		}
			    	}
			    }
		}

	},
	messages : {
		account :{
		required : '邮箱不能为空',
		remote : '该邮箱已经注册'
		
	},
	password : {
		required : '密码不能为空'
	},
	repassword : {
		required : '请确认密码',
		equalTo : '两次密码不一致'
	},
	username : {
		required : '请填写你的昵称',
		rangelength : '昵称在2-10个字之间',
		remote : '昵称已存在'
	},
	verify : {
		required : '请填写验证码',
		remote : '验证码错误'
	}
}



	});
});