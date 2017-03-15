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
	<form action="<?php echo U('addblog');?>" method="post">
		<table class="table">
			<tr>
				<th colspan="2">博文发布</th>
			</tr>
			<tr>
				<td align="right" width="10%">所属分类：</td>
				<td>
					<select name="cid">
						<option value="">===请选择分类===</option>
						<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["html"]); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">博文属性：</td>
				<td>
					<?php if(is_array($attr)): foreach($attr as $key=>$v): ?><label style="margin-right: 10px;">
							<input type="checkbox" name="aid[]" value="<?php echo ($v["id"]); ?>">&nbsp;<?php echo ($v["name"]); ?>
						</label><?php endforeach; endif; ?>
				</td>
			</tr>
			<tr>
				<td align="right">点击次数：</td>
				<td>
					<input type="text" name="click" value="100" />
				</td>
			</tr>
			<tr>
				<td align="right">标题：</td>
				<td>
					<input type="text" name="title">
				</td>
			</tr>
			<tr>
				<td align="right">摘要：</td>
				<td>
					<input type="text" name="summary" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<textarea name="content" id="content"></textarea>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input style="color: #6583ff;cursor: pointer;" type="submit" value="发布博文" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>