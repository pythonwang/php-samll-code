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
				<th width="15%">商铺名称</th>
				<th width="15%">商品标题</th>
				<th width="10%">商品价格</th>
				<th width="10%">商品销量</th>
				<th width="10%">所在地区</th>
				<th width="10%">所属分类</th>
				<th width="10%">下架时间</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($shop)): foreach($shop as $key=>$v): ?><tr>
					<td><?php echo ($v["shopname"]); ?></td>
					<td><?php echo ($v["main_title"]); ?></td>
					<td><?php echo ($v["price"]); ?></td>
					<td><?php echo ($v["buy"]); ?></td>
					<td><?php echo ($v["lname"]); ?></td>
					<td><?php echo ($v["cname"]); ?></td>
					<td><?php echo (date('Y-m-d',$v["end_time "])); ?></td>
					<td>
						<a class="btn btn-primary btn-xs active" role="button" href="<?php echo U('Goods/edit',array('gid' => $v['gid']));?>">编辑</a>
						<a class="btn btn-primary btn-xs active delAffirm" role="button" href="<?php echo U('Goods/del',array('gid' => $v['gid']));?>">删除</a>
					</td>
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	
	<div id="page" style="text-align: center;">
		<?php echo ($page); ?>		
	</div>
</div>
<script type="text/javascript" src="/app/shop/Public/Admin/js/common.js"> </script>
</body>
</html>