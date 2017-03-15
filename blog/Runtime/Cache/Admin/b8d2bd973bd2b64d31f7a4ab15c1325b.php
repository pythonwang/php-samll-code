<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/app/blog/Public/Admin/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/app/blog/Public/Admin/Js/index.js"></script>
<link rel="stylesheet" href="/app/blog/Public/Admin/Css/public.css" />
<link rel="stylesheet" href="/app/blog/Public/Admin/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<base target="iframe"/>
<head>
</head>
<body>
	<div id="top">
		<div class="menu">
			<!--<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a>-->
		</div>
		<div class="exit">
			<a href="<?php echo U('logout');?>" target="_self">退出</a>
			<a href="#" target="_blank">获得帮助</a>
			<a href="/app/blog" target="_blank">时光博客</a>
		</div>
	</div>
	<div id="left">
		<dl>
			<dt>博文管理</dt>
			<dd><a href="<?php echo U('Blog/index');?>">博文列表</a></dd>
			<dd><a href="<?php echo U('Blog/blog');?>">添加博文</a></dd>
			<dd><a href="<?php echo U('Blog/trach');?>">回收站</a></dd>
		</dl>
		<dl>
			<dt>属性管理</dt>
			<dd><a href="<?php echo U('Attrbute/index');?>">属性列表</a></dd>
			<dd><a href="<?php echo U('Attrbute/addattr');?>">添加属性</a></dd>
		</dl>
		<dl>
			<dt>分类管理</dt>
			<dd><a href="<?php echo U('Category/index');?>">分类列表</a></dd>
			<dd><a href="<?php echo U('Category/addcate');?>">添加分类</a></dd>
		</dl>
	</div>
	<div id="right">
		<iframe name="iframe" src="#"></iframe>
	</div>
</body>
</html>