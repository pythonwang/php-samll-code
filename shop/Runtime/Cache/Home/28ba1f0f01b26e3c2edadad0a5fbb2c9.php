<?php if (!defined('THINK_PATH')) exit();?>	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link href="/app/shop/Public/Home/tpl/css/reset.css" type="text/css" rel="stylesheet" >
<link href="/app/shop/Public/Home/tpl/css/common.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" src="/app/shop/Public/Home/js/jquery-1.8.2.min.js"></script>
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
					<?php if(is_array($selid)): foreach($selid as $key=>$v): ?><option value="<?php echo U('index',array('lid' =>$v['lid']));?>"><?php echo ($v["lname"]); ?></option><?php endforeach; endif; ?>
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
						<input class='s-text' type="text" name="keywords" value="请输入商品名称，地址等" onblur="if(this.value==''){this.value='请输入商品名称，地址等'}" onfocus="if(this.value=='请输入商品名称，地址等'){this.value=''}" />
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
				<a category=-1  href="/app/shop">首页</a>
				<?php if(is_array($nav)): foreach($nav as $k=>$v): ?><a category=<?php echo ($k); ?> href="<?php echo U('Index/index');?>/cid/<?php echo ($v["cid"]); ?>"><?php echo ($v["cname"]); ?></a><?php endforeach; endif; ?>
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
					<div  class='user-nav recent-view ' url="<?php echo U('Member/Index/getRecentView');?>" goodUrl ="<?php echo U('Home/Detail/index');?>" clearView="<?php echo U('Member/Index/clearRecentView');?>">
						<a class='title' href="">最近浏览</a>
						<ul class="menu">
							
							
						</ul>
					</div>
					<!-- 购物车 -->
					<div  class='user-nav my-cart ' id="my-cart" url="<?php echo U('Member/Cart/index');?>" goodUrl ="<?php echo U('Home/Detail/index');?>" delCartUrl ="<?php echo U('Member/Cart/del');?>">
						<a class='title' href="<?php echo U('Member/Cart/index');?>"><i>&nbsp;</i>购物车</a>
						<ul class="menu">
							<p>正在加载..</p>
						</ul>
					</div>
			</div>
		</div>
	</div> 


	<!-- 导航结束 -->
	
<!-- 载入公共头部文件结束 -->
	<link href="/app/shop/Public/Home/css/detail.css" type="text/css" rel="stylesheet" >
	<div id="map" class='position'>
		<a href="<?php echo U('Index/index',array('lid' =>$detail['glid']));?>"><?php echo ($detail["lname"]); ?></a><span>>></span><a href="<?php echo U('Index/index',array('cid' =>$detail['gcid']));?>"><?php echo ($detail["cname"]); ?></a><span>>></span><span><?php echo ($detail["shopname"]); ?></span>
	</div>
	<div id="content" class='position'>
		<div class='content-left'>
			<div class="goods-intro">
				<div class='goods-title'>
					<h1><?php echo ($detail["main_title"]); ?></h1>
					<h3><?php echo ($detail["sub_title"]); ?></h3>
				</div>
				<div class='deal-intro'>
					<div class='buy-intro'>
						<div class='price'>
							<div class='discount-price'>
								<span>¥</span><?php echo ($detail["price"]); ?>
							</div>
							<div class='cost-price'>
								<span class='discount'><?php echo ($detail["discount"]); ?>折</span>
								门店价<b>¥<?php echo ($detail["old_price"]); ?></b>
							</div>
						</div>
						<div class='deal-buy-cart'>
							<a href="<?php echo U('Member/Buy/index',array('gid' => $detail['gid']));?>" class='buy'></a>
							<a href="javascript:void(0);"  url="<?php echo U('Member/Cart/add');?>/gid/<?php echo ($detail["gid"]); ?>" id="addCart" class='cart'></a>
						</div>
						<div class='purchased'>
							<p class='people'>
								<span><?php echo ($detail["buy"]); ?></span>人已团购
							</p>
							<p class='time'>
								<?php echo ($detail["end_time"]); ?>
							</p>
						</div>
						<ul class='refund-intro'>
							<?php if(is_array($detail['server'])): foreach($detail['server'] as $key=>$v): ?><li>
									<?php echo ($v["img"]); ?>
									<span class='text'><?php echo ($v["name"]); ?></span>
								</li><?php endforeach; endif; ?>
						</ul>
					</div>
					<div class='image-intro'>
						<img src="/app/shop/Uploads/<?php echo ($detail["goods_med_img"]); ?>"/>
					</div>
				</div>
				<div class='collect'>
					<a class='collect-link' url="<?php echo U('Member/Index/addcollect');?>/gid/<?php echo ($detail["gid"]); ?>" id="addCollect" href='javascript:void(0);'><i></i>收藏本单</a>
					
					<div class='share'>
						
					</div>
					
				</div>
			</div>
			<div class='detail'>
				<ul class='plot-points'>
					<li class='active'><a href="#shop-site">商家位置</a></li>
					<li><a href="#details">本单详情</a></li>
				</ul>
				<div id="shop-site" class='shop-site'>
					<p class='site-title'>商家位置</p>
					<div class='box'>
						<div  id="bMap" class='map'>
							
						</div>
						<div class='info'>
							<h3><?php echo ($detail["shopname"]); ?></h3>
							<dl>
								<dt>地址:</dt>
								<dd><?php echo ($detail["shopaddress"]); ?></dd>
							</dl>
							<dl>
								<dt>地铁:</dt>
								<dd><?php echo ($detail["metroaddress"]); ?></dd>
							</dl>
							<dl>
								<dt>电话:</dt>
								<dd><?php echo ($detail["shoptel"]); ?></dd>
							</dl>
						</div>
					</div>
				</div>
				<div id="details"  class='details'>
					<?php echo ($detail["detail"]); ?>
				</div>
			</div>
		</div>
		<div class='content-right'>
			<div class='recommend'>
				<h3 class='recommend-title'>
					看过本团购的用户还看了
				</h3>
				
				<?php if(is_array($related)): foreach($related as $key=>$v): ?><div class='recommend-goods'>
					<a class='goods-image' href="<?php echo U('Home/Detail/index');?>/gid/<?php echo ($v["gid"]); ?>">
						<img alt="图像加载失败.." src="/app/shop/Uploads/<?php echo ($v["goods_small_img"]); ?>">
					</a>
					<h4>
						<a href="<?php echo U('Home/Detail/index');?>/gid/<?php echo ($v["gid"]); ?>"><?php echo ($v["main_title"]); ?></a>
					</h4>
					<p>
						<strong>¥<?php echo ($v["price"]); ?></strong>
						<span class='cost-price'>门店价<del><?php echo ($v["old_price"]); ?></del></span>
						<span class='num'>
							<span><?php echo ($v["buy"]); ?></span>
							 人已团购
						</span>
					</p>
				</div><?php endforeach; endif; ?>
				
			</div>
		</div>
		
		
		
	</div>
	<div class="c"></div>
	<div id="cover"></div>
	<div id="infoWindow">
		
	</div>
	<script src="/app/shop/Public/Home/js/detail.js"> </script>
	<script>
		var cartSucc = "<div class='colse'><a href='javascript:hideInfoWindow();'></a></div>\
			<ul class='status'>\
			<li class='ico'></li>\
			<li class='msg'>\
				<h3>添加成功!</h3>\
				<p>购物车内共有<span id='total'></span>种商品</p>\
			</li>\
		</ul>\
		<div class='goBtn'>\
			<a href='javascript:hideInfoWindow();'>继续浏览</a>\
			<a href='<?php echo U('Member/Cart/index');?>'>查看购物车</a>\
		</div>";
		var collectSucc = "<div class='colse'><a href='javascript:hideInfoWindow();'></a></div>\
			<ul class='status'>\
			<li class='ico'></li>\
			<li class='msg'>\
				<h3>收藏成功!</h3>\
			</li>\
		</ul>\
		<div class='goBtn'>\
			<a href='javascript:hideInfoWindow();'>继续浏览</a>\
			<a href='<?php echo U('Member/Index/collect');?>'>查看我的收藏</a>\
		</div>";
		var auth = false;
		<?php if($auth): ?>auth = true;<?php endif; ?>
	</script>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=X4NBVsOT37MthulzXpqIllyeD1p1xWGc"></script>
	<script>
		var shopcoord = <?php echo ($detail["shopcoord"]); ?>;
		// 百度地图API功能
		var map = new BMap.Map("bMap");            // 创建Map实例
		var point = new BMap.Point(shopcoord.lng, shopcoord.lat);    // 创建点坐标
		map.centerAndZoom(point,15);                     	// 初始化地图,设置中心点坐标和地图级别。
		map.enableScrollWheelZoom();                        //启用滚轮放大缩小
		var marker1 = new BMap.Marker(point);  // 创建标注
		map.addOverlay(marker1);              // 将标注添加到地图中
		map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}));  //右上角，仅包含平移和缩放按钮
	</script>
	<br/>
	<br/>
	<br/>
<!-- 载入公共头部文件开始 --> 

	
	<div id="footer">
		<p>本demo不用于任何商业目的，仅供学习与交流</p>
	</div>
	</body>
</html>
<!-- 载入公共头部文件结束 -->