<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/app/blog/Public/Admin/Css/public.css" />
</head>
<body>
	<form action="<?php echo U('runattr');?>" method="post">
		<table class="table">
			<tr>
				<th colspan="2">添加博文属性</th>
			</tr>
			<tr>
				<td align="right">属性名称：</td>
				<td>
					<input type="text" name="name" />
				</td>
			</tr>
			<tr>
				<td align="right">标题颜色：</td>
				<td>
					<input type="text" name="color">
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="保存添加">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>