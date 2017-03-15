<?php
function unlimitedforlevel($category,$html='--',$pid=0,$level=0) {
		$arr = array();
		foreach ($category as $v) {
			if ($v['pid'] ==$pid) {
				$v['level'] =$level +1;
				$v['html'] = str_repeat($html,$level);
				$arr[] =$v;
				$arr = array_merge($arr,unlimitedforlevel($category,$html,$v['cid'],$level +1));
				# code...
			}
			# code...
		}
		return $arr;
	}
	//地区分级
	function localforlevel($local,$html='--',$pid=0,$level=0) {
		$arr = array();
		foreach ($local as $v) {
			if ($v['pid'] ==$pid) {
				$v['level'] =$level +1;
				$v['html'] = str_repeat($html,$level);
				$arr[] =$v;
				$arr = array_merge($arr,localforlevel($local,$html,$v['lid'],$level +1));
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

//传递一个子分类ID返回父级分类
function getparent($parents,$cid) {
	$arr = array();
	foreach ($parents as $v) {
		if ($v['cid'] == $cid) {
			$arr[] = $v;
			$arr = array_merge(getparent($parents,$v['pid']),$arr);
		}
		
	}
	return $arr;
}

//首页商品栏传递一个子分类ID返回父级分类
function gettop($topcate,$cid) {
	$arr = array();
	foreach ($topcate as $v) {
		if ($v['cid'] == $cid) {
			$arr[] = $v;
			$arr = array_merge(gettop($topcate,$v['pid']),$arr);
		}
		
	}
	return $arr;
}
//传递一个子分类ID返回父级分类/地区
function localparent($parents,$lid) {
	$arr = array();
	foreach ($parents as $v) {
		if ($v['lid'] == $lid) {
			$arr[] = $v;
			$arr = array_merge(localparent($parents,$v['pid']),$arr);
		}
		
	}
	return $arr;
}
