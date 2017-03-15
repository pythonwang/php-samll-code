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
	
	<!-- 载入公共头部文件-->
	<!-- 载入商品筛选-->
	<!-- 商品过滤开始 -->
	<div id="filter">
		<div class='hots'>
			<span>热门团购：</span>
			<div class='box'>
				<?php if(is_array($hotgroup)): foreach($hotgroup as $key=>$v): ?><a href="<?php echo U('Home/Index/index');?>/cid/<?php echo ($v["cid"]); ?>"><?php echo ($v["cname"]); ?></a><?php endforeach; endif; ?>
			</div>	
		</div>
		
		<div class='filter-box'>
			<div class='category filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>分类：</span>
					<div class='box'>
						<?php if(is_array($topcate)): foreach($topcate as $key=>$v): echo ($v); endforeach; endif; ?>
					</div>
				</div>
				<?php if(isset($soncate)): ?><div class='filter-label-level-2'>
					<div class='box'>
						<?php if(is_array($soncate)): foreach($soncate as $key=>$v): echo ($v); endforeach; endif; ?>
					</div>
				</div><?php endif; ?>
			</div>
			<div class='locality filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>区域：</span>
					<div class='box'>
						<?php if(is_array($toplocal)): foreach($toplocal as $key=>$v): echo ($v); endforeach; endif; ?>
					</div>
				</div>
				<?php if(isset($sonlocal)): ?><div class='filter-label-level-2'>
						<div class='box'>
							<?php if(is_array($sonlocal)): foreach($sonlocal as $key=>$v): echo ($v); endforeach; endif; ?>
						</div>
					</div><?php endif; ?>
			</div>
			<div class='price filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>价格：</span>
					<div class='box'>
						<?php if(is_array($price)): foreach($price as $key=>$v): echo ($v); endforeach; endif; ?>
					</div>
				</div>
			</div>	
			<div class='screen'>
				<div>
					<a class='active' href="<?php echo ($orderurl['d']); ?>">默认排序</a>
					<a href="<?php echo ($orderurl['b']); ?>">销量<b></b></a>
					<a href="<?php echo ($orderurl['pd']); ?>">价格<b></b></a>
					<a href="<?php echo ($orderurl['pa']); ?>">价格<b style="background-position:-45px -16px;"></b></a>
					<a style="border:0;" href="<?php echo ($orderurl['t']); ?>">发布时间<b></b></a>
				</div>
			</div>
		</div>	
	</div>
	<!-- 商品过滤结束 -->
	<link href="/app/shop/Public/Home/css/index.css" type="text/css" rel="stylesheet" >
	<!-- 页面主体开始 -->
	<div id="main">
		<div class='content'>
			<?php if(is_array($goods)): foreach($goods as $key=>$v): ?><div class='item'>
				<div class='cover'>
					<a href="<?php echo U('Detail/index',array('gid' =>$v['gid']));?>"><img src="/app/shop/Uploads/<?php echo ($v["goods_med_img"]); ?>"/></a>
				</div>
				<a class='link' href="<?php echo U('Index/Detail/index');?>/gid/<?php echo ($v["gid"]); ?>">
					<h3><?php echo ($v["main_title"]); ?></h3>
					<p class='describe'><?php echo ($v["sub_title"]); ?></p>
				</a>
				<p class='detail'>
					<strong>¥<?php echo ($v["price"]); ?></strong>
					<span>门店价<span>-</span><del><?php echo ($v["old_price"]); ?></del></span>
					<a href="<?php echo U('Detail/index',array('gid' =>$v['gid']));?>"></a>
				</p>
				<p class='total'>
					<strong><?php echo ($v["buy"]); ?></strong>
					人已参与
				</p>
			</div><?php endforeach; endif; ?>
			<div class='c'></div>
			<div class='page'>
				<?php echo ($page); ?>
			</div>
		</div>
		<div class='sidebar'>
			<div class='hot-products'>
				<h3>热卖商品</h3>
				<ul>
					<?php if(is_array($hotgoods)): foreach($hotgoods as $w=>$k): ?><li>
						<h6><span><?php echo ($w+1); ?></span><a href=""><?php echo ($k["main_title"]); ?></a></h6>
						<a href="<?php echo U('Detail/index',array('gid' =>$k['gid']));?>"><img src="/app/shop/Uploads/<?php echo ($k["goods_mini_img"]); ?>"/></a>
						<div class='info'>
							<em>¥<?php echo ($k["price"]); ?></em>
							<p>每天<span><?php echo ($k["buy"]); ?></span>人团购</p>
						</div>
						</li><?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class='c'></div>
	
	<div id="footer">
		<p>本demo不用于任何商业目的，仅供学习与交流</p>
	</div>
	</body>
</html>
</body>
</html>