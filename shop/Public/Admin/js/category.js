$(function(){
	$('form[name=categoryForm]').validate({
		errorElement : 'span',
		success : function(label) {
			label.addClass('success');
		},
		    rules: {
		      cname: {
		        maxlen: 10,
		        required: true
		      },
		      title: {
		        maxlen:40,
				required: true
		      },
		      keywords: {
		        maxlen:60,
				required: true
		      },
		      email: {
		        required: true,
		        email: true
		      },
		      description: {
		        maxlen:80,
				required: true
		      },
		      sort: {
				num:"1,100",
				required: true
			  }
		    },
		    messages: {
		      cname: {
		        maxlen: "不能大于10个字符 ",
		        required: "不能为空 "
		      },
		      title: {
		        maxlen: "不能大于40个字符 ",
		        required: "不能为空 "
		      },
		      keywords: {
		        maxlen: "不能大于60个字符 ",
		        required: "不能为空 "
		      },
		      description: {
		        maxlen: "不能大于80个字符 ",
		        required: "不能为空 "
		    },
		      sort: {
		        num: "排序不能大于100 ",
		        required: "不能为空 "
		     }
		}
	});
}) 