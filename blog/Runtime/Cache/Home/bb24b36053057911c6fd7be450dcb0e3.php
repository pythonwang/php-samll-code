<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/app/blog/Public/Admin/Css/public.css" />
</head>
<body>
	<table class="table">
	<tr>   
				<th colspan="2" style="text-align: left; border-right:none;"><a href="/app/blog">博客首页</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo U('Mblog/myshow');?>">我的博客</a></th>
			</tr>
			<tr>
		<tr >
			<th style="text-align:center;">ID</th>
			<th style="text-align:center;">标题</th>
			<th style="text-align:center;">所属分类</th>
			<th style="text-align:center;">点击次数</th>
			<th style="text-align:center;">发布时间</th>
			<th style="text-align:center;">操作</th>
		</tr>
		<?php if(is_array($blog)): foreach($blog as $key=>$v): ?><tr>
				<td width="8%" style="text-align:center;"><?php echo ($v["id"]); ?></td>
				<td width="35%"><?php if(is_array($v["attr"])): foreach($v["attr"] as $key=>$k): ?><strong style="color: <?php echo ($k["color"]); ?>">[<?php echo ($k["name"]); ?>]</strong><?php endforeach; endif; echo ($v["title"]); ?>
				</td>
				<td style="text-align:center;width: 15%"><?php echo ($v["cate"]); ?></td>
				<td style="text-align:center;width: 9%"><?php echo ($v["click"]); ?></td>
				<td style="text-align:center;"><?php echo (date('Y-m-d H:i',$v["time"])); ?></td>
				<td style="text-align:center;width: 15%">
				
					[<a href="<?php echo U('totrach',array('id' => $v['id']));?>">还原</a>]
					[<a href="<?php echo U('delete',array('id' => $v['id']));?>">彻底删除</a>]
					
				</td>
			</tr><?php endforeach; endif; ?>
		
		<tr>
			<td colspan="6" align="center" height="40px">
					<a style="color: green;font-size:18px" href="<?php echo U('alldel');?>">清空回收站</a>
				</td>
		</tr>
	
	</table>
</body>
</html>