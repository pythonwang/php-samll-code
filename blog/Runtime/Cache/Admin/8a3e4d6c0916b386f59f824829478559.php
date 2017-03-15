<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/app/blog/Public/Admin/Css/public.css" />
</head>
<body>
	<form action="<?php echo U('runaddcate');?>" method="post">
	<table class="table">
	<tr>
		<th colspan="2">添加栏目分类</th>
	</tr>
	<tr>
		<td align="right">分类栏目名称：</td>
		<td>
			<input type="text" name="name" />
		</td>
	</tr>
	<tr>
		<td align="right">排序：</td>
		<td>
			<input type="text" name="sort" value="100" />
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="hidden" name="pid" value="<?php echo ($pid); ?>" />
			<input type="submit" value="保存添加" />
		</td>
	</tr>
	</table>
	</form>
</body>
</html>