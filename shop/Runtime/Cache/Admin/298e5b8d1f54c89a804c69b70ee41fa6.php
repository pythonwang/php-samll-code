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
	<span class='title'>分类列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered table-hover'>
		<thead>
			<tr>
				<th width="5%"></th>
				<th width="25%">分类名称</th>
				<th width="30%">分类标题</th>
				<th width="10%">分类排序</th>
				<th width="10%">是否显示</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><td><?php echo ($v["cid"]); ?></td>
				<td><?php echo ($v["html"]); echo ($v["cname"]); ?></td>
				<td><?php echo ($v["title"]); ?></td>
				<td><?php echo ($v["sort"]); ?></td>
				<td>
					<?php if($v['display'] == true): ?>显示
						<?php else: ?>
						隐藏<?php endif; ?>
				</td>
				<td>
					<a class="btn btn-primary btn-xs active" role="button" href="<?php echo U('Category/add',array('cid' => $v['cid']));?>">添加子类</a>
					<a class="btn btn-primary btn-xs active" role="button" href="<?php echo U('Category/edit',array('cid' => $v['cid']));?>">编辑</a>
					<a class="btn btn-primary btn-xs active delAffirm" role="button" href="<?php echo U('Category/del',array('cid' => $v['cid']));?>">删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
</div>
<script type="text/javascript" src="/app/shop/Public/Admin/js/common.js"> </script>
</body>
</html>