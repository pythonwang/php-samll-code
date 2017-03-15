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
	<span class='title'>地区列表</span>
</div>
<div id="content">
	<table id="table" class='table table-striped table-bordered table-hover'>
		<thead>
			<tr>
				<th width="5%"></th>
				<th width="25%">地区名称</th>
				<th width="10%">地区排序</th>
				<th width="10%">是否显示</th>
				<th >操作</th>
			</tr>
		</thead>
		<tbody>
		
			<?php if(is_array($local)): foreach($local as $key=>$v): ?><tr>
				<td><?php echo ($v["lid"]); ?></td>
				<td><?php echo ($v["html"]); echo ($v["lname"]); ?></td>
				<td><?php echo ($v["sort"]); ?></td>
				<td>
					<?php if($v['display'] == 1): ?>显示
						<?php else: ?>
						隐藏<?php endif; ?>
				</td>
				<td>
					<a class="btn btn-primary btn-xs active" role="button" href="<?php echo U('Local/add',array('lid' => $v['lid']));?>">添加子地区</a>
					<a class="btn btn-primary btn-xs active" role="button" href="<?php echo U('Local/edit',array('lid' => $v['lid']));?>">编辑</a>
					<a class="btn btn-primary btn-xs active delAffirm" role="button" href="<?php echo U('Local/del',array('lid' => $v['lid']));?>">删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		</tbody>
	</table>
</div>
<script type="text/javascript" src='/app/shop/Public/Admin/js/common.js'></script>
</body>
</html>