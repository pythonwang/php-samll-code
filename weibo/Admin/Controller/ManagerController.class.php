<?php
namespace Admin\Controller;
use Think\Controller;
class ManagerController extends Controller {

	public function login() {

		if (!empty($_POST)) {
			$verify = new \Think\Verify();
			if (!$verify->check($_POST['captcha'])) {
				echo "验证码错误";
				# code...
			}else{
				
				$user = new \Model\ManagerModel();
				$rst = $user->checkNamePwd($_POST['mg_name'],$_POST['mg_pwd']);


				if ($rst===false) {
					echo "用户名或密码错误";
					# code...
				}else{
					session('mg_name',$rst['mg_name']);
					session('mg_id',$rst['mg_id']);
					$this->redirect('Index/index');
				}
			}
			# code...
		}




		$this->display();
	
}

public function logout() {
	session(null);
	$this ->redirect('Manager/login');
}
	public function verifyImage() {
		$config =array(
			'imageH' => 40,
			'imageW' => 120,
			'fontSize' =>14,
			'length' =>4,


			);
		$verify = new \Think\Verify($config);
		$verify->entry();
	}

	public function showlist() {

		$info = D('Manager')->select();
		$rinfo = $this->getRoleInfo();
		
			# code...
		
		$this->assign('rinfo',$rinfo);
		$this->assign('info',$info);
		$this->display();
	}

	public function upd($mg_id) {
		if (!empty($_POST)) {
			$manager = D('Manager');
			$manager->create();
			$z = $manager->save();
			if ($z) {
				$this->success('修改管理员成功',U('showlist'));
				# code...
			}else{
				$this->error('修改管理员失败',U('showlist'));
			}
			# code...
		}else{
		$info = D('Manager')->find($mg_id);

		$rinfo = $this->getRoleInfo();
		$this->assign('info',$info);
		$this->assign('rinfo',$rinfo);
		$this->assign('mg_id',$mg_id);
		$this->display();
	}
}

	public function getRoleInfo() {

		$rrinfo = D('Role')->select();
		$rinfo = array();
		foreach ($rrinfo as $k => $v) {
			$rinfo[$v['role_id']] = $v['role_name'];
		}
		return $rinfo;

	}
	



}