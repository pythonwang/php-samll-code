<?php
namespace Home\Controller;
use Think\Controller;

class EmptyController extends Controller {

	public function _empty() {
		echo "<img src='/app/weibo/Public/Home/images/404.jpg' alt=''>";
	}
}