<?php
function unlimitedforlevel($cate,$html='--',$pid=0,$level=0) {
		$arr = array();
		foreach ($cate as $v) {
			if ($v['pid'] ==$pid) {
				$v['level'] =$level +1;
				$v['html'] = str_repeat($html,$level);
				$arr[] =$v;
				$arr = array_merge($arr,unlimitedforlevel($cate,$html,$v['id'],$level +1));
				# code...
			}
			# code...
		}
		return $arr;
	}
function unlimitedforlayer($cate,$pid=0) {
	$arr = array();
	foreach ($cate as $v) {
		if ($v['pid'] == $pid) {
			$v['child'] = unlimitedforlayer($cate,$v['id']);
			$arr[] = $v;
			
		}
		
	}
	return $arr;
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
//传递一个父级分类ID返回所有子分类ID
function getchildid($cate,$pid) {
	$arr = array();
	foreach ($cate as $v) {
		if ($v['pid'] == $pid) {
			$arr[] =$v['id'];
			$arr = array_merge($arr,getchildid($cate,$v['id']));
		}
		
	}
	return $arr;
}
//传递一个子分类ID返回父级分类
function getparent($cate,$id) {
	$arr = array();
	foreach ($cate as $v) {
		if ($v['id'] == $id) {
			$arr[] = $v;
			$arr = array_merge(getparent($cate,$v['pid']),$arr);
		}
		
	}
	return $arr;
}