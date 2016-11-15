<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<table border="1">
<tr><th>id</th><th>user</th><th>email</th></tr>
<?php if(is_array($list)): foreach($list as $key=>$obj): ?><tr><th><?php echo ($obj["id"]); ?></th><th><?php echo ($obj["user"]); ?></th><th><?php echo ($obj["email"]); ?></th></tr><?php endforeach; endif; ?>
</table>
<?php echo ($page); ?>
</body>
</html>