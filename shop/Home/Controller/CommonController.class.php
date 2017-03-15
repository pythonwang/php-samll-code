<?php
namespace Home\Controller;
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
		$this->setRecentView();
		$this->auth = $_SESSION['uid'];
	}
	public function setnav() {
		$nav = M('category')->field('cid,cname')->where(array('pid' => 0, 'display' => 1))->order('sort')->select();
		$this->nav = $nav;
	}
	//最近浏览
	public function setRecentView() {
		$Encry = new \Component\Encry();
		$key = $Encry::encrypt('recent-view');
        $value = isset($_COOKIE[$key]) ? unserialize($Encry::decrypt($_COOKIE[$key])) : array();
        if(!in_array($_GET['gid'],$value)){
        		array_unshift($value, $_GET['gid']);
        	}
        setcookie($key,$Encry::encrypt(serialize($value)),time()+86400,'/');
        
	}
}