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
<link href="/app/shop/Public/welcome.htmlcss/index.css" rel="stylesheet" type="text/css" />
<div id="map">
	<span class='title'>站点概况</span>
</div>
<div id="content" style="margin-left:30px; float:left;">
	<table id="table" class='table table-striped table-bordered'>
		<tbody>
			<tr>
				<th>名称</th>
				<th>值</th>
			</tr>	
			<tr>
				<td>系统信息</td>
				<td><?php echo ($info["system"]); ?></td>
			</tr>
			<tr>
				<td>WEB服务器</td>
				<td><?php echo ($info["soft"]); ?></td>
			</tr>
			<tr>
				<td>服务器IP</td>
				<td><?php echo ($info["ip"]); ?></td>
			</tr>
			<tr>
				<td>端口</td>
				<td><?php echo ($info["tcp"]); ?></td>
			</tr>
			<tr>
				<td>Thinkphp版本</td>
				<td><?php echo ($info["tpversion"]); ?></td>
			</tr>
			<tr>
				<td>现在时间</td>
				<td><?php echo ($info["time"]); ?></td>
			</tr>
			
		</tbody>
	</table>
	
	
</div>
</body>
</html>