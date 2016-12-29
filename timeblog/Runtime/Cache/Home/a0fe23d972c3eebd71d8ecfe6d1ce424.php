<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>时光微博-注册</title>
	<link rel="stylesheet" href="/app/weibo2/Public/Css/regis.css" />
	<script type="text/javascript" src="/app/weibo2/Public/Js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/app/weibo2/Public/Js/jquery-validate.js"></script>
	<script type="text/javascript">
		var checkAccount = "<?php echo U('checkAccount');?>";
		var checkUsername = "<?php echo U('checkUsername');?>";
		var checkVerify = "<?php echo U('checkVerify');?>";
	</script>
	<script type="text/javascript" src="/app/weibo2/Public/Js/register.js"></script>
	
	
	<script type='text/javascript'>
		
	</script>

	
</head>
<body>
	<div id='logo'></div>
	<div id='reg-wrap'>
	     
		<form action="<?php echo U('runRegis');?>" method='post' name='register' >
			<fieldset>
				<legend>用户注册</legend>
				<p id="zhanghao">
					<label for="account">登录账号：</label>
					<input type="text" name='account' id='account' class='input'/>
				</p>
				<p>
					<label for="pwd">登录密码：</label>
					<input type="password" name='password' id='password' class='input'/>
				</p>
				<p>
					<label for="pwded">确认密码：</label>
					<input type="password" name='repassword' class='input'/>
				</p>
				<p>
					<label for="uname">昵称：</label>
					<input type="text"  name='username' id='username' class='input'/>
				</p>
				<p>
					<label for="verify">验证码：</label>
					<input type="text" name='verify' class='input' id='verify'/>
					<img src="<?php echo U('verifyImage');?>" onClick="this.src=this.src+'?'+Math.random()"  alt="" />
				</p>
				<p class='run'>
					<input type="submit" value='马上注册' id='regis' />
				</p>
			</fieldset>
		</form>
	</div>
</body>
</html>