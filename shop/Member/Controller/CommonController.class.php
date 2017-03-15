<?php
namespace Member\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function _initialize() {

		if (isset($_COOKIE['auto']) && !isset($_SESSION['uid'])) {
			$value = explode('|',$_COOKIE['auto']);
			
			$ip = get_client_ip();
//本次登录IP和上次登录IP一致

			if ($ip==$value[1]) {
				$ac = $value[0];
				$user=M('user')->getByEmail($ac);
				if ($user) {
					session('uid',$user['uid']);
					
				}
							
						}	
			
		}
		$this->setnav();
		$this->auth = $_SESSION['uid'];
	}
	public function setnav() {
		$nav = M('category')->field('cid,cname')->where(array('pid' => 0, 'display' => 1))->order('sort')->select();
		$this->nav = $nav;
	}
}