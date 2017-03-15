<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/app/blog/Public/Admin/Css/public.css" />
</head>
<body>
<form action="<?php echo U('Category/sortcate');?>" method="post">
	<table class="table">
		<tr>
			<td>ID</td>
			<td>名称</td>
			<td>级别</td>
			<td>排序</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><tr>
			<td><?php echo ($v["id"]); ?></td>
			<td><?php echo ($v["html"]); echo ($v["name"]); ?></td>
			<td><?php echo ($v["level"]); ?></td>
			<td>
				<input type="text" name="<?php echo ($v["id"]); ?>" value="<?php echo ($v["sort"]); ?>" />
			</td>
			<td>
				[<a href="<?php echo U('addcate',array('pid'=>$v['id']));?>">添加子分类</a>]
				[<a href="">修改</a>]
				[<a href="">删除</a>]
			</td>
		</tr><?php endforeach; endif; ?>
		<tr>
			<td colspan="5" align="center">
				<input type="submit" value="排序">
			</td>
		</tr>
	</table>
	</form>
</body>
</html>