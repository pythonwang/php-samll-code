<?php
function encryption($value,$type=0) {
	$key = md5(C('ENCRYPION_KEY'));
	//echo $key;

	if (!$type) {
		return str_replace('=','', base64_encode($value ^ $key));
		
	}
	$value =base64_decode($value);
	return $value ^ $key;
	
}
//格式化显示时间
function time_format($time) {
	//当前时间
	$now = time();
	//今天时间零点
	$today = strtotime(date('y-m-d',$now));
	//传递时间与当前时秒相差的秒数
	$diff = $now - $time;
	$str = '';
	switch ($time) {
		case $diff < 60 :
			$str = $diff . '秒前';
			break;
		case $diff < 3600 :
			$str = floor($diff/60) . '分钟前';
			break;
		case $diff < (3600 * 8) :
			$str = floor($diff/3600) . '小时前';
			break;
		case $time > $today :
			$str = '今天&nbsp;&nbsp;' . date('H:i',$time);	
			break;
		default :
			$str = date('Y-m-d H:i:s',$time);

	}
	return $str;
	}
//替换微博内容的URL地址。@用户表情
	function replace_weibo ($content) {
		if (empty($content)) return;
		
		$preg = '/(?:http:\/\/)?([\w.]+[\w\/]*\.[\w.]+[\w\/]*\??[\w=\&\+\%]*)/is';
		$content = preg_replace($preg,'<a href="http//\\1" target="_blank">\\1</a>',$content);

		$preg = '/@(\S+)\s/is';
		$content = preg_replace($preg,'<a href="' . __APP__ . '/User/\\1">@\\1</a>',$content);
		
		$preg = '/\[(\S+?)\]/is';
	preg_match_all($preg, $content, $arr);
	//载入表情包数组文件
	$phiz = include './Public/Data/phiz.php';
	if (!empty($arr[1])) {
		foreach ($arr[1] as $k => $v) {
			$name = array_search($v, $phiz);
			if ($name) {
				$content = str_replace($arr[0][$k], '<img src="' . __ROOT__ . '/PUBLIC/Images/phiz/' . $name . '.gif" title="' . $v . '"/>', $content);
			}
		}
	}
	return str_replace(C('FILTER'), '***', $content);
}


	