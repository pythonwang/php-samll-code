<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>时光博客</title>
	<link rel="stylesheet" href="/app/blog/Public/Home/Css/common.css" />
	<script type="text/JavaScript" src='/app/blog/Public/Home/Js/jquery-1.7.2.min.js'></script>
	<script type="text/JavaScript" src='/app/blog/Public/Home/Js/common.js'></script>
	<link rel="stylesheet" href="/app/blog/Public/Home/Css/list.css" />
	<script type="text/javascript">
		var delblog = '<?php echo U("delblog");?>';
	</script>
	
<!--头部-->
	</head>
<body>
<!--头部-->
	


	
<?php $cate = M('cate')->order('sort')->select(); $cate = unlimitedforlayer($cate); ?>

	<div class='top-nav-wrap'>
		<ul class='nav-lv1'>
			<li class='nav-lv1-li'>
				<a href="/app/blog" class='top-cate'>博客首页</a>
			</li>
			
			<li class='nav-lv1-li'>
				<a href="<?php echo U('trash');?>" class='top-cate'>回收站(<?php echo ($count); ?>)</a>
				
				
			</li>
			</foreach>
			
		</ul>
	</div>
<!--主体-->

	<div class='main'>
	<p style="font-size: 18px;">&nbsp;我的博客：</p>
		<div class='main-left'>
		<?php if(is_array($blog)): foreach($blog as $key=>$v): ?><dl class="del">
				<dt><?php echo ($v["name"]); ?></dt>
				<dd class='channel'><?php echo ($v["title"]); ?></dd>
				<dd class='info'>
					<span class='time'>发布于：<?php echo (time_format($v["time"])); ?></span>
					<span class='click'>点击:<?php echo ($v["click"]); ?></span>

				</dd>
				<dd class='content'><?php echo ($v["summary"]); ?></dd>
				
				<dd style="text-indent:500px;height: 22px;">
				<span><a style="color: #2B96E1;" href="<?php echo U('change',array('id' => $v['id']));?>">[修改]</a></span>
				<span class='del-blog' did='<?php echo ($v["id"]); ?>' style="color: #2B96E1;cursor: pointer;">[删除]</span>
				</dd>
				
				<dd class='read'>
					<a href="<?php echo U('/show/' . $v['id']);?>" target="_blank">阅读全文>></a>
				</dd>
			</dl><?php endforeach; endif; ?>
			<p><?php echo ($page); ?></p>
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
<script type="text/javascript" src='/app/blog/Public/Home/Js/delblog.js'></script>
	<div class='bottom'>
		<div></div>
	</div>
</body>
</html>