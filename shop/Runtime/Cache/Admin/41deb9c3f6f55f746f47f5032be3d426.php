<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登陆到镁团后台管理中心</title>
<script type="text/javascript" src="/app/shop/Public/Home/js/jquery-1.8.2.min.js"></script>
<link href="/app/shop/Public/Admin/bootstrap-2/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="/app/shop/Public/Admin/bootstrap-2/js/bootstrap.js"></script>
<script src="/app/shop/Public/Admin/bootstrap-2/js/bootstrap.min.js"></script>
<style>
body{background:#d0dee3;}
#loginBox{
	width:496px;
	height:300px;
	position:absolute;
	left:50%;
	top:50%;
	margin-left:-248px;
	margin-top:-160px;
}
#loginBox h1{
	font-size:25px;
	text-align:center;
	color:#333;
	height: 90px;
	text-shadow:0px 2px 3px #ddd;
}
	
</style>
</head>
<body>
<div id="loginBox">
	<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;镁团团购后台管理中心</h1>
	<form class="form-horizontal" id="loginForm" action="<?php echo U('Admin/Login/login');?>" method="post">
    	<div class="control-group">
    		<label class="control-label" for="inputEmail">用户名</label>
    		<div class="controls">
    			<input type="text" name="username" id="inputEmail" placeholder="请输入用户名..">
    		</div>
    	</div>
   		<div class="control-group">
    		<label class="control-label" for="inputPassword">密码</label>
    		<div class="controls">
    			<input type="password"  name="password" id="inputPassword" placeholder="请输入密码..">
    		</div>
   		</div>
		<div class="control-group">
    		<label class="control-label" for="inputCode">验证码</label>
    		<div class="controls">
    			<input type="text" style="width:120px;" url="<?php echo U('Admin/Login/checkCode');?>" id="inputCode" placeholder="请输入验证码..">
    			<img src="<?php echo U('verifyImage');?>" onClick="this.src=this.src+'?'+Math.random()"  alt="" />
			</div>
   		</div>
    	<div class="control-group">
    		<br/>
    		<div class="controls">
    			<button type="submit" class="btn">登陆</button>
    		</div>
    	</div>
    </form>
</div>
<script>
	$('#loginForm').submit(function(){
		var code = $('#inputCode').val();
		var url = $('#inputCode').attr('url');
		$.ajax({
			url:url,
			type:'post',
			dataType:'json',
			data:'code='+code,
			success:function(result){
				if(result.status === true){
					$('#loginForm')[0].submit();
				}else{
					alert('验证码输入有误!');
				}
			}
		})
		return false;
	})
	
</script>


</body>
</html>