<?php if (!defined('THINK_PATH')) exit();?><dl>
				<dt>最新布发</dt>
				<?php if(is_array($new)): foreach($new as $key=>$v): ?><dd>
					<a href="<?php echo U('/show/' . $v['id']);?>"><?php echo ($v["title"]); ?></a>
					<span>(<?php echo ($v["click"]); ?>)&nbsp;&nbsp;&nbsp;(<?php echo (time_format($v["time"])); ?>)</span>
				</dd><?php endforeach; endif; ?>

			</dl>