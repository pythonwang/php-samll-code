$(function () {

	
		//头像上传
		$('#face').uploadify({
			swf : PUBLIC + '/Uploadify/uploadify.swf',
			uploader : uploadUrl,
			width : 120,
			height : 30,

			buttonImage : PUBLIC + '/Uploadify/browse-btn.png',
			fileTypeDesc : 'Image File',
			fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',//允许选择图片类型
			
			//上传成功回调函数
			onUploadSuccess : function (file,data,response) {
				var info = eval("("+data+")");
				
				$('#face-img').attr('src', ROOT + '/Uploads/' + info.path.max);
				$('input[name=face180]').val(info.path.max);
				$('input[name=face80]').val(info.path.med);
				$('input[name=face50]').val(info.path.mini);
				
				
			}
		});
		
	
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
	$('form[name=editPwd]').validate({
		errorElement : 'span',
		success : function(label) {
			label.addClass('success');
		},
		rules : {
			old : {
				required : true,
			    user : true,
			    
		},
		new : {
			required : true,
			user : true,
		},
		newed : {
			required : true,
			equalTo : "#new"
		}
		
	},
	messages : {
		old :{
		    required : '请填写旧密码',
		
	},
	new : {
		required : '请设置新密码'
	
	},
	newed : {
			required : '请确认密码',
			equalTo : '两次密码不一致'
		}
}



	
});
});