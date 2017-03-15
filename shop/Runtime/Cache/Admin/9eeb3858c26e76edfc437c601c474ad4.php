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
<style type="text/css"> 
*{ margin:0; padding:0;}
body { font:12px/1.5 Arial; color:#666; background:#fff;}
ul,li{ list-style:none;}
img{border:0 none;}
/*---------------------------------------demo css--------------------------------------------*/
.date_selector, .date_selector *{width: auto;height: auto;border: none;background: none;margin: 0;padding: 0;text-align: left;text-decoration: none;}
.date_selector{background:#fbfbfb;border: 1px solid #ccc;padding: 10px;margin:0;margin-top:-1px;position: absolute;z-index:100000;display:none;border-radius: 3px;box-shadow: 0 0 5px #aaa;box-shadow:0 2px 2px #ccc; width:240px;}
.date_selector_ieframe{position: absolute;z-index: 99999;display: none;}
.date_selector .nav{width: 17.5em;}
.date_selector .nav p{clear: none;}
.date_selector .month_nav, .date_selector .year_nav{margin: 0 0 3px 0;padding: 0;display: block;position: relative;text-align: center;}
.date_selector .month_nav{float: left;width: 55%;}
.date_selector .year_nav{float: right;width: 42%;margin-right: -8px;}
.date_selector .month_name, .date_selector .year_name{font-weight: bold;line-height: 20px;}
.date_selector .button{display: block;position: absolute;top: 0;width:18px;height:18px;line-height:16px;font-weight:bold;color:#5985c7;text-align: center;font-size:12px;overflow:hidden;border: 1px solid #ccc;border-radius:2px;}
.date_selector .button:hover, .date_selector .button.hover{background:#5985c7;color: #fff;cursor: pointer;border-color:#3a930d;}
.date_selector .prev{left: 0;}
.date_selector .next{right: 0;}
.date_selector table{border-spacing: 0;border-collapse: collapse;clear: both;margin: 0; width:220px;}
.date_selector th, .date_selector td{width: 2.5em;height: 2em;padding: 0 !important;text-align: center !important;color: #666;font-weight: normal;}
.date_selector th{font-size: 12px;}
.date_selector td{border:1px solid #f1f1f1;line-height: 2em;text-align: center;white-space: nowrap;color:#5985c7;background: #fff;}
.date_selector td.today{background: #eee;}
.date_selector td.unselected_month{color: #ccc;}
.date_selector td.selectable_day{cursor: pointer;}
.date_selector td.selected{background:#2b579a;color: #fff;font-weight: bold;}
.date_selector td.selectable_day:hover, .date_selector td.selectable_day.hover{background:#5985c7;color: #fff;}
/*-----------------------------------------------------------------------------------*/
</style> 
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=X4NBVsOT37MthulzXpqIllyeD1p1xWGc"></script>
<script type="text/javascript" src="http://www.js-css.cn/jscode/jquery.min.js"></script>
<script type="text/javascript" src="/app/shop/Public/Admin/js/jquery.date_input.pack.js"></script>

<script type="text/javascript" src='/app/shop/Public/Ueditor/ueditor.config.js'></script>
	<script type="text/javascript" src='/app/shop/Public/Ueditor/ueditor.all.min.js'></script>
	<script type="text/javascript">
	window.UEDITOR_HOME_URL = "/app/shop/Public/Ueditor/";
	window.onload = function () {
		window.UEDITOR_CONFIG.imageUrl="<?php echo U('upload');?>";
		window.UEDITOR_CONFIG.imagePathFormat='/app/shop/Public/Uploads/image/';
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
		 
		UE.getEditor('detail',{ initialFrameHeight: 300,initialFrameWidth: 700});
	}
	</script>
	<script type="text/javascript">
$(function(){
	$('.date_picker').date_input();
	})
</script>
<div id="map">
	<span class='title'>编辑商品</span>
</div>
<div id="content">
	<form  action="<?php echo U('Goods/runedit',array('gid' => $goods['gid']));?>" method="post" enctype="multipart/form-data">
	<table class='table table-striped table-bordered'>
		<thead>
			<tr>
				<th width="20%">名称</th>
				<th>值</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>商铺名称</td>
				<td>
					<input type="hidden" name="shopid" value="<?php echo ($goods["shopid"]); ?>"/>
					<?php echo ($goods["shopname"]); ?>
				</td>
			</tr>
			<tr>
				<td>分类名称</td>
				<td>
					
					<select name="cid" >
						<option value="<?php echo ($goods["cid"]); ?>"><?php echo ($goods["cname"]); ?></option>
						<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><option value="<?php echo ($v["cid"]); ?>"><?php echo ($v["html"]); echo ($v["cname"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>所在地区</td>
				<td>
					<select name="lid" >
						<option value="<?php echo ($goods["lid"]); ?>"><?php echo ($goods["lname"]); ?></option>
						<?php if(is_array($local)): foreach($local as $key=>$v): ?><option value="<?php echo ($v["lid"]); ?>"><?php echo ($v["html"]); echo ($v["lname"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>商品主标题</td>
				<td>
					<input type="text" name="main_title" value="<?php echo ($goods["main_title"]); ?>" />
				</td>
			</tr>
			<tr>
				<td>商品副标题</td>
				<td>
					<textarea name="sub_title"><?php echo ($goods["sub_title"]); ?></textarea>
				</td>
			</tr>
			<tr>
				<td>现价</td>
				<td>
					<input type="text" name="price" value="<?php echo ($goods["price"]); ?>"/>
				</td>
			</tr>
			<tr>
				<td>原价</td>
				<td>
					<input type="text" name="old_price" value="<?php echo ($goods["old_price"]); ?>"/>
				</td>
			</tr>
			<tr>
				<td>上架时间</td>
				<td>
					<input class="date_picker" type="text" name="begin_time" value="<?php echo (date('Y-m-d',$goods["begin_time "])); ?>" />
				</td>
			</tr>
			<tr>
				<td>下架时间</td>
				<td>
					<input class="date_picker" type="text" name="end_time" value="<?php echo (date('Y-m-d',$goods["end_time "])); ?>" />
				
				</td>
			</tr>
			<tr>
				<td>商品展示图</td>
				<td>
					<input type="file" name="goodsimage" accept="image/png,image/jpg,image/jpeg">
					
					
					
					<img width="200" src="/app/shop/Uploads/<?php echo ($goods["goods_max_img"]); ?>"/>
					<input type="hidden" name="old_img_1" value="<?php echo ($goods["goods_max_img"]); ?>"/>
					<input type="hidden" name="old_img_2" value="<?php echo ($goods["goods_med_img"]); ?>"/>
					<input type="hidden" name="old_img_3" value="<?php echo ($goods["goods_small_img"]); ?>"/>
					<input type="hidden" name="old_img_4" value="<?php echo ($goods["goods_mini_img"]); ?>"/>
				</td>
			</tr>	
			<tr>
				<td>商品服务</td>
				<td>
					<?php if(is_array($server)): foreach($server as $k=>$v): if(in_array((${k}), is_array($goods['goods_server'])?$goods['goods_server']:explode(',',$goods['goods_server']))): ?><label>
						<input type="hidden" name="goods" value="{$k}">
							<input type="checkbox" checked=true name="goods_server[]" value="<?php echo ($k); ?>">
							<?php echo ($v["name"]); ?>
						</label><br/>
						<?php else: ?>
						<label>
							<input type="checkbox" name="goods_server[]" value="<?php echo ($k); ?>">
							<?php echo ($v["name"]); ?>
						</label><br/><?php endif; endforeach; endif; ?>
				</td>
			</tr>	
			<tr>
				<td>商品细节展示</td>
				<td>
					<textarea name='detail' id='detail'><?php echo (htmlspecialchars_decode($goods["detail"])); ?></textarea> 
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: center;"><input type="submit" class='btn' /></td>
			</tr>
		</tbody>
	</table>
	</form>
	
	
	
</div>


</body>
</html>