<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<script type="text/javascript" src="/app/shop/Public/Admin/js/jquery.min.js"></script>
<link href="/app/shop/Public/Admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<script src="/app/shop/Public/Admin/bootstrap/js/bootstrap.min.js"></script>


<link href="/app/shop/Public/Admin/css/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="map">
	<span class='title'>商品列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered table-hover'>
		<thead>
			<tr>
				<th width="15%">用户名</th>
				<th >邮箱</th>
				<th width="10%">电话</th>
				<th width="10%">用户余额</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
					<td><?php echo ($v["uname"]); ?></td>
					<td><?php echo ($v["email"]); ?></td>
					<td><?php echo ($v["phone"]); ?></td>
					<td><?php echo ($v["balance"]); ?></td>
					<td>
						<a class="btn btn-primary btn-xs active delAffirm" role="button" href="<?php echo U('Admin/User/deluser');?>/uid/<?php echo ($v["uid"]); ?>">删除</a>
					</td>
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	
	<div id="page">
		<?php echo ($page); ?>		
	</div>
</div>
</body>
</html>