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
<hdui/>
<script type="text/javascript" src="/app/shop/Public/Admin/js/locality.js"></script>
<div id="map">
	<span class='title'>添加地区</span>
</div>
<div id="content">
	<form id="localityForm" action="<?php echo U('Local/runadd');?>" method="post">
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="20%">名称</th>
				<th>值</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>所属地区</td>
				<td>
					<select name="pid">
						<?php if(is_array($parents)): foreach($parents as $key=>$p): if(empty($p['lname']) != 1): ?><option value="<?php echo ($p["lid"]); ?>"><?php echo ($p["lname"]); ?></option><?php endif; endforeach; endif; ?>
						
						<option value="0">顶级地区</option>
						<?php if(is_array($local)): foreach($local as $key=>$v): ?><option value="<?php echo ($v["lid"]); ?>"><?php echo ($v["html"]); echo ($v["lname"]); ?></option><?php endforeach; endif; ?>
					</select>
					
					
				</td>
			</tr>
			<tr>
				<td>地区名称</td>
				<td>
					<input type="text" name="lname" />
				</td>
			</tr>
			<tr>
				<td>地区排序</td>
				<td>
					<input name="sort" type="text" />
				</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td>
					<lable>
						<input type="radio" name="display" checked=true value="1"/>	
						<span>显示</span>
					</lable>
					<lable>
						<input type="radio" name="display" value="0"/>	
						<span>隐藏</span>
					</lable>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class='btn' /></td>
			</tr>
		</tbody>
	</table>
	</form>
	
	
	
</div>
</body>
</html>