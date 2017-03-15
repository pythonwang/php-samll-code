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
				<th>商品标题</th>
				<th width="15%">价格</th>
				<th width="10%">数量</th>
				<th width="10%">总价</th>
				<th width="10%">状态</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($order)): foreach($order as $key=>$v): ?><tr>
					<td><?php echo ($v["main_title"]); ?></td>
					<td><?php echo ($v["price"]); ?></td>
					<td><?php echo ($v["goods_num"]); ?></td>
					<td><?php echo ($v["total_money"]); ?></td>
					<td><?php echo ($v["status"]); ?></td>
					<td>
						<a class="btn btn-primary btn-xs active delAffirm" role="button" href="<?php echo U('Admin/Order/delorder');?>/oid/<?php echo ($v["orderid"]); ?>">删除</a>
					</td>
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	
	<div id="page">
		<?php echo ($page); ?>		
	</div>
</div>
<script type="text/javascript" src="/app/shop/Public/Admin/js/common.js"> </script>
</body>
</html>