$(function () {

	//修改资料选项卡
	$('#sel-edit li').click( function () {
		var index = $(this).index();
		$(this).addClass('edit-cur').siblings().removeClass('edit-cur');
		$('.form').hide().eq(index).show();
	} );

	//城市联动
	var province = '';
	$.each(city, function (i, k) {
		province += '<option value="' + k.name + '" index="' + i + '">' + k.name + '</option>';
	});
	$('select[name=province]').append(province).change(function () {
		var option = '';
		if ($(this).val() == '') {
			option += '<option value="">请选择</option>';
		} else {
			var index = $(':selected', this).attr('index');
			var data = city[index].child;
			for (var i = 0; i < data.length; i++) {
				option += '<option value="' + data[i] + '">' + data[i] + '</option>';
			}
		}
		
		$('select[name=city]').html(option);
	});
		address = address.split(' ');
		$('select[name=province]').val(address[0]);
		$.each(city,function(i,k) {
			if (k.name == address[0]) {
				var str = '';
				for (var j in k.child) {
					str += '<option value="' + k.child[j] + '" ';
					if(k.child[j] == address[1]) {
						str += 'selected="selected"';
					}
					str += '>' + k.child[j] + '</option>';
				}
				$('select[name=city]').html(str);
			}

		});
		//星座默认
		$('select[name=night]').val(constellation);
		//头像上传
		$('#face').uploadify({
			swf : PUBLIC + '/Uploadify/uploadify.swf',
			uploader : uploadUrl,
			width : 120,
			height : 30,

			buttonImage : PUBLIC + '/Uploadify/browse-btn.png',
			fileTypeDesc : 'Image File',
			fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',//允许选择图片类型
			formData : {'session_id' : sid},
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