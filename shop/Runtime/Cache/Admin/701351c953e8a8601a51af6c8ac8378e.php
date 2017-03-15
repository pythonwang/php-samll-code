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
	<span class='title'>添加分类</span>
</div>
<div >
	<form  action="<?php echo U('Category/addup');?>" method="post">
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="20%">名称</th>
				<th>值</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>所属分类</td>
				<td>
				
					<select name="pid">

					<?php if(is_array($parents)): foreach($parents as $key=>$p): if(empty($p['cname']) != 1): ?><option value="<?php echo ($p["cid"]); ?>"><?php echo ($p["cname"]); ?></option><?php endif; endforeach; endif; ?>
						
						<option value="0">顶级分类</option>
						
						<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["cid"]); ?>"><?php echo ($v["html"]); echo ($v["cname"]); ?></option><?php endforeach; endif; ?>
					</select>
					
					
				</td>
			</tr>
			<tr>
				<td>分类名称</td>
				<td>
					<input type="text" name="cname" />
				</td>
			</tr>
			<tr>
				<td>分类标题</td>
				<td>
					<textarea name="title" class='input'></textarea>
				</td>
			</tr>
			<tr>
				<td>分类关键字</td>
				<td>
					<textarea name="keywords" ></textarea>
				</td>
			</tr>
			<tr>
				<td>分类描述</td>
				<td>
					<textarea name="description"></textarea>
				</td>
			</tr>
			<tr>
				<td>分类排序</td>
				<td>
					<input name="sort" type="text" />
				</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td>
					<lable>
						<input type="radio" name="display" checked=true value="1" />	
						<span>显示</span>
					</lable>
					<lable>
						<input type="radio" name="display" value="0" />	
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