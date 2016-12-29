<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>微博用户列表</title>
	<link rel="stylesheet" href="/app/weibo2/Public/Admin/Css/common.css" />
	<script type="text/javascript" src='/app/weibo2/Public/Admin/Js/jquery-1.8.2.min.js'></script>
	<script type="text/javascript" src='/app/weibo2/Public/Admin/Js/common.js'></script>
</head>
<body>
	<div class='status'>
		<span>评论列表</span>
	</div>
	<table class="table">
		<tr>
			<th>ID</th>
			<th>评论内容</th>
			<th>评论用户</th>
			<th>评论时间</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($comment)): foreach($comment as $key=>$v): ?><tr>
				<td width='50' align='center'><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["content"]); ?></td>
				<td width='100'><?php echo ($v["username"]); ?></td>
				<td width='100' align='center'><?php echo (date('y-m-d H:i', $v["time"])); ?></td>
				<td width='60'>
					<a href="<?php echo U('delComment', array('id' => $v['id'], 'wid' => $v['wid']));?>" class='del'></a>
				</td>
			</tr><?php endforeach; endif; ?>
		<tr>
			<td colspan='5' align='center' height='60'><?php echo ($page); ?></td>
		</tr>
	</table>
</body>
</html>