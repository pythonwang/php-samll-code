<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" type="text/css" href="/app/blog/Public/Admin/Css/public.css" />
	
	<script type="text/javascript" src='/app/blog/Public/Ueditor/ueditor.config.js'></script>
	<script type="text/javascript" src='/app/blog/Public/Ueditor/ueditor.all.min.js'></script>
	<script type="text/javascript">
	window.UEDITOR_HOME_URL = "/app/blog/Public/Ueditor/";
	window.onload = function () {
		window.UEDITOR_CONFIG.imageUrl="<?php echo U('upload');?>";
		window.UEDITOR_CONFIG.imagePathFormat='/app/blog/Public/Uploads/image/';
		//自定义请求地址
            UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl;
            UE.Editor.prototype.getActionUrl = function(action) {
                if (action == 'uploadimage') {    //上传图片
                      return "<?php echo U('upload',array('action'=>'uploadimage'),'');?>";
                } else  if(action == 'config') {    //加载配置
                        return this._bkGetActionUrl.call(this, action);
                }
            }             
            //自定义请求地址结束
		 
		UE.getEditor('content',{ initialFrameHeight: 300,initialFrameWidth: 900});
	}
	</script>
</head>
<body>

	<form action="<?php echo U('upblog',array('id' =>$id));?>" method="post">
		<table class="table">
			<tr>
				<th style="border-right:none;text-align: left;color: blue;"><a href="/app/blog">博客首页</a></th>
				<th style="border-left:none;">博文发布</th>
			</tr>
			<tr>
				<td align="right" width="10%">所属分类：</td>
				<td>
					选择：<select name="cid">
					<?php if(is_array($kind)): foreach($kind as $key=>$k): ?><option value="<?php echo ($cid); ?>"><?php echo ($k["name"]); ?></option><?php endforeach; endif; ?>
						<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["html"]); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
			
			<?php if(is_array($blog)): foreach($blog as $key=>$b): ?><tr>
				<td align="right">博文标题：</td>
				<td>
					<input type="text" name="title" value='<?php echo ($b["title"]); ?>' />
				</td>
			</tr>
			<tr>
				<td align="right">博文摘要：</td>
				<td>
					<input type="text" name="summary" value='<?php echo ($b["summary"]); ?>'/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<textarea name="content" id="content" ><?php echo (htmlspecialchars_decode($b["content"])); ?></textarea>
				</td>
			</tr>
			<tr><?php endforeach; endif; ?>
				<td align="center" colspan="2">
					<input style="color: #6583ff;cursor: pointer;" type="submit" value="修改博文" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>