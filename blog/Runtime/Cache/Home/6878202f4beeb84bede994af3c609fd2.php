<?php if (!defined('THINK_PATH')) exit();?>

			<dl>
				<dt>热门博文</dt>
				<?php if(is_array($menu)): foreach($menu as $key=>$v): ?><dd>
					<a href="<?php echo U('/show/' . $v['id']);?>"><?php echo ($v["title"]); ?></a>
					<span>(<?php echo ($v["click"]); ?>)</span>
				</dd><?php endforeach; endif; ?>
			</dl>