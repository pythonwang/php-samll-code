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
	<span class='title'>商铺列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered table-hover'>
		<thead>
			<tr>
				<th width="15%">商铺名称</th>
				<th width="25%">商铺地址</th>
				<th width="25%">地铁地址</th>
				<th width="15%">商家电话</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($shop)): foreach($shop as $key=>$v): ?><tr>
					<td><?php echo ($v["shopname"]); ?></td>
					<td><?php echo ($v["shopaddress"]); ?></td>
					<td><?php echo ($v["metroaddress"]); ?></td>
					<td><?php echo ($v["shoptel"]); ?></td>
					<td>
						<a class="btn btn-primary btn-xs active" role="button" href="<?php echo U('Goods/add',array('shopid' => $v['shopid']));?>">添加商品</a>
						<a class="btn btn-primary btn-xs active" role="button" href="<?php echo U('Shop/edit',array('shopid' => $v['shopid']));?>">编辑</a>
						<a class="btn btn-primary btn-xs active delAffirm" role="button" href="<?php echo U('Shop/del',array('shopid' => $v['shopid']));?>">删除</a>
					</td>
				</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
	
	<div id="page" style="text-align: center;">
		<?php echo ($page); ?>		
	</div>
</div>
<script type="text/javascript" src='/app/shop/Public/Admin/js/common.js'></script>
</body>
</html>