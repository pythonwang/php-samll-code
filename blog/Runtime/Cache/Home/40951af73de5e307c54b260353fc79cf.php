<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>时光博客</title>
	<link rel="stylesheet" href="/app/blog/Public/Home/Css/common.css" />
	<script type="text/JavaScript" src='/app/blog/Public/Home/Js/jquery-1.7.2.min.js'></script>
	<script type="text/JavaScript" src='/app/blog/Public/Home/Js/common.js'></script>
	<link rel="stylesheet" href="/app/blog/Public/Home/Css/show.css" />
	<link rel="stylesheet" href="/app/blog/Public/Ueditor/third-party/SyntaxHighlighter/shCoreDefault.css" />
	<script type="text/javascript" src='/app/blog/Public/Ueditor/third-party/SyntaxHighlighter/shCore.js'></script>
	<script type="text/javascript">
		SyntaxHighlighter.all();
	</script>

	
<!--头部-->
	</head>
<body>
<!--头部-->
	<div class='top-list-wrap'>
		<div class='top-list'>
			<ul class='l-list'>
				<li><a href="<?php echo U('Admin/Index/index');?>" target='_blank'>时光博客</a></li>
				<li><a href="#" target='_blank'>时光博客</a></li>
				<li><a href="#" target='_blank'>时光博客</a></li>
			</ul>
			<ul class='r-list'>
				<li><a href="#" target='_blank'>时光博客</a></li>
				<li><a href="时光博客" target='_blank'>时光博客</a></li>
			</ul>
		</div>
	</div>


	<div class='top-search-wrap'>
		<div class='top-search'>
			<a href="/app/blog" target='_blank' class='logo'>
				<img src="/app/blog/Public/Home/Images/logo.png"/>
			</a>
			<div class='search-wrap'>
				<form action="<?php echo U('Index/sechblog');?>" method='get'>
					<input type="text" name='keyword' class='search-content'/>
					<input type="submit" name='sech' value='搜索'/>
				</form>
			</div>
		</div>
	</div>
<?php $cate = M('cate')->order('sort')->select(); $cate = unlimitedforlayer($cate); ?>

	<div class='top-nav-wrap'>
		<ul class='nav-lv1'>
			<li class='nav-lv1-li'>
				<a href="/app/blog" class='top-cate'>博客首页</a>
			</li>
			<?php if(is_array($cate)): foreach($cate as $key=>$v): ?><li class='nav-lv1-li'>
				<a href="<?php echo U('/more/' . $v['id']);?>" class='top-cate'><?php echo ($v["name"]); ?></a>
				
				<?php if($v["child"]): ?><ul>
						<?php if(is_array($v["child"])): foreach($v["child"] as $key=>$k): ?><li><a href="<?php echo U('/more/' . $k['id']);?>"><?php echo ($k["name"]); ?></a></li><?php endforeach; endif; ?>
					</ul><?php endif; ?>
			</li><?php endforeach; endif; ?>
			<!--<li class='nav-lv1-li'>
			<a href="<?php echo U('Admin/Blog/blog');?>" target="_blank" class='top-cate'>发布博文</a>
			<ul>
				<li><a href="<?php echo U('Login/index');?>">管理员登录</a>
				</li>
			</ul>
			</li>-->
		</ul>
	</div>

<!--主体-->
	<div class='main'>
		<div class='main-left'>
			<div class='location'>
				<a href="">首页</a>>
				<?php $last = count($parent) -1; ?>
				<?php if(is_array($parent)): foreach($parent as $key=>$v): ?><a href="<?php echo U('/more/' . $v['id']);?>"><?php echo ($v["name"]); ?></a><?php if($key != $last): ?>><?php endif; endforeach; endif; ?>
			</div>
			<div class="title">
				<p><?php echo ($blog["title"]); ?></p>
				<div>
					<span class='fl'>作者：<?php echo ($blog["username"]); ?>&nbsp;&nbsp;&nbsp;发布于：<?php echo (time_format($blog["time"])); ?></span>
					<span class='fr'>已被阅读<?php echo ($blog["click"]); ?>次</span>
				</div>
			</div>
			<div class='content' style="word-break: break-all;">
				<?php echo ($blog["content"]); ?>
			</div>
		</div>
	<!--主体右侧-->
		<div class='main-right'>
<dl>
	<?php if(isset($_SESSION['uid'])){ $user = M('user')->where(array('id' =>session('uid')))->select(); } ?>
			
				<?php if(isset($_SESSION["uid"])): if(is_array($user)): foreach($user as $key=>$v): ?><dd style="height: 60px;line-height:60px;">
					<span style=""><a style="margin-left: 80px; font-size: 25px;" href="#"><?php echo ($v["username"]); ?></a>
					<a style="font-size: 15px; color:#367113;" href="<?php echo U('Mblog/logout');?>">&nbsp;&nbsp;&nbsp;&nbsp;[退出]</a></span>
				</dd><?php endforeach; endif; ?>
				<?php else: ?><dd style="height: 60px;line-height:60px;">
					<a style="margin-left:110px;font-size: 20px;color:#367113;" href="<?php echo U('Login/index');?>" target="_blank">登录?</a>
				</dd><?php endif; ?>
				<dd style="height: 30px;font-size: 20px;">
					<a style="margin-left: 50px;color: black;" href="<?php echo U('Mblog/blog');?>">发布博文</a>&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: black;" href="<?php echo U('Mblog/myshow');?>">我的博客</a>
				</dd>
				
			</dl>
<?php echo W('Hot/menu');?>
			
<?php echo W('Hot/newest');?>
			<dl>
				<dt>友情连接</dt>
				<dd>
					<a href="www.timeblog.online:8888" target="_blank">时光微博</a>
				</dd>

				<dd>
					<a href="">许愿墙</a>
				</dd>
				<dd>
					<a href="">待定。。。</a>
				</dd>
			</dl>
		</div>
	</div>
<!--底部-->
	<div class='bottom'>
		<div></div>
	</div>
</body>
</html>