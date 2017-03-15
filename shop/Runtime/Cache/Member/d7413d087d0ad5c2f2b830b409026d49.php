<?php if (!defined('THINK_PATH')) exit();?>	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link href="/app/shop/Public/Home/tpl/css/reset.css" type="text/css" rel="stylesheet" >
<link href="/app/shop/Public/Home/tpl/css/common.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" src="/app/shop/Public/Member/js/jquery-1.8.2.min.js"></script>

<link href="/app/shop/Public/Admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<script src="/app/shop/Public/Admin/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/app/shop/Public/Member/js/common.js"></script>

<meta name="keywords" content="" />
<meta name="description" content="" />
<title><?php echo ($webInfo["title"]); ?></title>

</head>
<body>
	<!-- 顶部开始 -->
	<div id="top">
		<div class='position'>
			<div class='left ' style="color: #21b3a7;">

		所在城市：<select name="pageselect" onchange="self.location.href=options[selectedIndex].value" >
					<?php if(isset($_SESSION['citylid'])): ?><option value=""><?php echo ($_SESSION['cityname']); ?></option>
					
					<?php else: ?>
					<option value="">北京</option><?php endif; ?>
					<?php if(is_array($selid)): foreach($selid as $key=>$v): ?><option value="<?php echo U('Member/Index/selcity',array('lid' =>$v['lid']));?>"><?php echo ($v["lname"]); ?></option><?php endforeach; endif; ?>
					</select>
				
			</div>
			<div class='right'>
				<a href="javascript:addFavorite2();">收藏</a>
			</div>
		</div>
	</div>
	<!-- 顶部结束 -->
	<!-- 头部开始 -->
	<div id="header">
	
			

		<div class='position'>
			<div class='logo'>
				<a style="line-height:60px;" href="/app/shop">镁团购</a>
				<a style="font-size:16px;" href="/app/shop">www.shopgroup.online</a>
			</div>
			<div class='search'>
				<div class='item'>
					<a href="<?php echo U('Home/Index/index');?>/keywords/小时代">小时代</a>
					<a href="<?php echo U('Home/Index/index');?>/keywords/KTV">KTV</a>
					<a href="<?php echo U('Home/Index/index');?>/keywords/电影">电影</a>
					<a href="<?php echo U('Home/Index/index');?>/keywords/全聚德">全聚德</a>
				</div>
				<div class='search-bar'>
					<form action="<?php echo U('Home/Index/index');?>" method="get">
						<input class='s-text' type="text" name="keywords" value="请输入商品名称，地址等" onblur="if(this.value==''){this.value='请输入商品名称，地址等'}" onfocus="if(this.value=='请输入商品名称，地址等'){this.value=''}">
						<input class='s-submit' type="submit" value='搜索'>
					</form>
				</div>
			</div>
			<div class='commitment'>
				
			</div>
		</div>
	</div>
	<!-- 头部结束 -->
	<!-- 导航开始-->
	<div id="nav">
		<div class='position'>
			<!-- 分类相关 -->
			<div class='category'>
				<a category=-1  href="/app/shop/">首页</a>
				<?php if(is_array($nav)): foreach($nav as $k=>$v): ?><a category=<?php echo ($k); ?> href="<?php echo U('Home/Index/index');?>/cid/<?php echo ($v["cid"]); ?>"><?php echo ($v["cname"]); ?></a><?php endforeach; endif; ?>
			</div>
			<script>
				
				/**
				* 获取cookie
				* @param name
				* @returns
				*/
				function getCookie(name){
					var arr = document.cookie.split(';');
					for(var i=0;i<arr.length;i++){
						var	arr2 = arr[i].split('=');
						var preg = new RegExp('\\b'+name+'\\b','i')
						if(preg.test(arr2[0])){
							return	arr2[1];
						}
					}
				}
				$('.category a').click(function(){
					var category = $(this).attr('category');
					document.cookie = "category="+category+';path=/';
				})
				var category = getCookie('category');
				$('.category a').each(function(){
					if($(this).attr('category') == category){
						$(this).addClass('active');
					}else{
						$(this).removeClass('active');
					}
				})
			</script>
			<!-- 用户相关 -->
			<div id="user-relevance" class='user-relevance'>
				<?php if(isset($auth)): ?><div class='user-nav login-reg'>
						<a class='title' href="<?php echo U('Member/Login/quit');?>">退出</a>
					</div>
					<!--我的团购 -->	
					<div class='user-nav my-hdtg '>
						<a class='title' href="<?php echo U('Member/Order/index');?>">我的团购</a>
						<ul class="menu">
							<li><a href="<?php echo U('Member/Order/index');?>">我的订单</a></li>	
							<li><a href="<?php echo U('Member/Index/collect');?>">我的收藏</a></li>
							<li><a href="<?php echo U('Member/Account/index');?>">账户余额</a></li>
							<li><a href="<?php echo U('Member/Account/setting');?>">账户设置</a></li>
						</ul>
					</div>
				<?php else: ?>	
					<!--登录注册-->
					<div class='user-nav login-reg'>
						<a class='title' href="<?php echo U('Member/Reg/index');?>">注册</a>
					</div>
					<div class='user-nav login-reg'>	
						<a class='title' href="<?php echo U('Member/Login/index');?>">登录</a>
					</div><?php endif; ?>
					<!-- 最近浏览 -->	
					<div  class='user-nav recent-view ' id ='my-view' url="<?php echo U('Member/Index/getRecentView');?>" goodUrl ="<?php echo U('Home/Detail/index');?>" clearView="<?php echo U('Member/Index/clearRecentView');?>">
						<a class='title' href="">最近浏览</a>
						<ul class="menu">
							
							
						</ul>
					</div>
					<!-- 购物车 -->
					<div  class='user-nav my-cart ' id="my-cart" url="<?php echo U('Member/Cart/index');?>" goodUrl ="<?php echo U('Index/Detail/index');?>" delCartUrl ="<?php echo U('Member/Cart/del');?>">
						<a class='title' href="<?php echo U('Member/Cart/index');?>"><i>&nbsp;</i>购物车</a>
						<ul class="menu">
							<p>正在加载..</p>
						</ul>
					</div>
			</div>
		</div>
	</div> 


	<!-- 导航结束 -->
	
	<!-- 载入公共头部文件-->
	<link href="/app/shop/Public/Member/css/buy.css" type="text/css" rel="stylesheet" >
	<div class='position'>
		<form method="post" action="<?php echo U('Member/Buy/payment');?>">
		<input type="hidden" name="gid" value="<?php echo ($goods["gid"]); ?>">
		<input type="hidden" name="price" value="<?php echo ($goods["price"]); ?>">
		<div id="main">
			<div class='step'>
				<ul>
					<li class='current'>1.查看订单 </li>
					<li>2.选择支付方式 </li>
					<li>3.购买成功 </li>
				</ul>	
			</div>
			
			<table class='buy-table' border=0>
			<thead>
				<tr>
					<th width='35%'>商品</th>
					<th width='20%' style="text-align:left;">数量</th>
					<th width='20%'>单价</th>
					<th width='10%'>总价</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class='goods-show'>
						<a href="<?php echo U('Home/Detail/index');?>/gid/<?php echo ($goods["gid"]); ?>">
						<img src="/app/shop/Uploads/<?php echo ($goods["goods_mini_img"]); ?>">
						<?php echo ($goods["main_title"]); ?></a>
					</td>
					<td class='goods-num'>
						<a href="javascript:void(0);" class='reduce' id="reduce"></a>
						<input id="goods_num" name="goods_num" type="text" value=1> 
						<a href="javascript:void(0);" class='add' id="add"></a>
					</td>
					<td id="price"><?php echo ($goods["price"]); ?></td>
					<td id="totalPrice"><?php echo ($goods["price"]); ?></td>
				</tr>
			</tbody>
			</table>
			<div class='address-list'>
			<table>
				<thead>
					<tr>
						<th>选择</th>
						<th width="20%">收货人</th>
						<th>地址/邮编</th>
						<th width="20%">电话/手机</th>
						<th width="20%">操作</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($address)): foreach($address as $key=>$v): ?><tr>
						<td>
							<input type="radio" checked=true name="addressid" value="<?php echo ($v["addressid"]); ?>">
						</td>
						<td>
							<?php echo ($v["consignee"]); ?>
						</td>
						<td>
						<?php echo ($v["province"]); ?>-<?php echo ($v["city"]); ?>-<?php echo ($v["county"]); ?>-<?php echo ($v["street"]); ?>
						</td>
						<td>
							<?php echo ($v["tel"]); ?>
						</td>
						<td>
							<a href="<?php echo U('Member/Account/delAddress');?>/addressid/<?php echo ($v["addressid"]); ?>">删除</a>
						</td>
					</tr><?php endforeach; endif; ?>
				</tbody>
			</table>	
			</div>
			
			<!-- 订单提交 -->
			<div class='bottom'>
				<input type="submit" class='submit' value="提交订单">
			</div>
		</div>
		</form>
	</div>
	<script>
		$('#reduce').click(function(){
			var num = Number($('#goods_num').val());
			if(num<=1){
				return false;
			}
			$('#goods_num').val(num-1)
			var total = Number($("#price").html())*(num-1);
  			$("#totalPrice").html(total)
		})
		$('#add').click(function(){
			var num = Number($('#goods_num').val());
			$('#goods_num').val(num+1)

			var total = Number($("#price").html())*(num+1);
  			$("#totalPrice").html(total)
		})
	</script>
</body>
</html>