<?php
namespace Admin\Controller;
use Component\AdminController;

class AuthController extends AdminController {
	public function showlist() {
		$info = $this ->getInfo();
		
		$this->assign('info',$info);
		$this->display();
	}

	public function add() {
		if (!empty($_POST)) {
			$auth = new \Model\AuthModel();
			$z = $auth -> addAuth($_POST);
			if ($z) {
				echo "ok";
				# code...
			}else{
				echo "error";
			}

			
			# code...
		}else{
		$info = $this->getInfo(true);
		$authinfo = array();
		foreach ($info as $k => $v) {
			$authinfo[$v['auth_id']] = $v['auth_name'];
			# code...
		}
		$this->assign('authinfo',$authinfo);

		$this->display();
	}
}

	public function getInfo($flag=false) {
		$auth = D('Auth');
		if ($flag == true) {
			$info = D('Auth')->where('auth_level<2')->order('auth_path asc')->select();
			# code...
		}else{

		$info = D('Auth')->order('auth_path asc')->select();
	}
		foreach ($info as $k => $v) {
			$info[$k]['auth_name'] = str_repeat('------------>',$v['auth_level']) .$info[$k]['auth_name'];
			# code...
		}
		return $info;
	}
}