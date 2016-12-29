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
		<span>微博用户检索</span>
	</div>
	<div style='width:600px;text-align:center;margin : 20px auto;'>
		<form action="/app/weibo2/index.php/Admin/User/sechUser.html?type=1&sech=4" method='get'>
			检索方式：
			<select name="type">
				<option value="1">用户ID</option>
				<option value="0">用户昵称</option>
			</select>
			<input type="text" name='sech'/>
			<input type="submit" value='' class='see'/>
		</form>
	</div>
	<table class="table">
		<?php if(isset($user) && !$user): ?><tr>
				<td align='center'>没有检索到相关用户</td>
			</tr>
		<?php else: ?>
			<tr>
				<th>ID</th>
				<th>用户昵称</th>
				<th>头像</th>
				<th>关注信息</th>
				<th>注册时间</th>
				<th>账号状态</th>
				<th>操作</th>
			</tr>
			<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
					<td><?php echo ($v["id"]); ?></td>
					<td><?php echo ($v["username"]); ?></td>
					<td width='80' align='center'>
					<?php if($v["face"]): ?><img src="/app/weibo2/Uploads/<?php echo ($v["face"]); ?>" width='50' height='50'/><?php else: ?><img src="/app/weibo2/Public/Images/noface.gif" width='50' height='50'/><?php endif; ?>
					</td>
					<td align='center'>
						<ul>
							<li>关注：<?php echo ($v["follow"]); ?></li>
							<li>粉丝：<?php echo ($v["fans"]); ?></li>
							<li>微博：<?php echo ($v["weibo"]); ?></li>
						</ul>
					</td>
					<td width='100' align='center'><?php echo (date('Y-m-d', $v["registime"])); ?></td>
					<td width='60' align='center'><?php if($v["lock"]): ?>锁定<?php endif; ?></td>
					<td width='100' align='center'>
						<?php if($v["lock"]): ?><a href="<?php echo U('lockUser', array('id' => $v['id'], 'lock' => 0));?>" class='add lock'>解除锁定</a>
						<?php else: ?>
							<a href="<?php echo U('lockUser', array('id' => $v['id'], 'lock' => 1));?>" class='add lock'>锁定用户</a><?php endif; ?>
					</td>
				</tr><?php endforeach; endif; endif; ?>
		<tr height='50'>
			<td align='center' colspan='7'><?php echo ($page); ?></td>
		</tr>
	</table>

</body>
</html