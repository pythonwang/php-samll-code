<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index() {
		$this->display();
	}
//登录表单
	public function login() {
		if (!IS_POST) {
			E('页面不存在');
		}
		//验证码校验
		$verify = new \Think\Verify();
		if (!$verify->check($_POST['code'])) {
			$this->error("验证码错误");
		}
		$db = M('user');
		$user = $db->where(array('username' => $_POST['username']))->find();

		if (!$user || $user['password'] !== md5($_POST['password'])) {			
			$this->error('账号或密码错误');	
		}
		$data = array(
			'id' => $user['id'],
			'logintime' => time(),
			'loginip' => get_client_ip()
			);
		$db->save($data);

		session('uid', $user['id']);
		session('username', $user['username']);
		session('logintime', date('Y-m-d H:i:s',$user['logintime']));
		session('loginip', $user['loginip']);
		redirect(U('Index/index'));
	}

	public function verify() {
		$config = array(
			'imageH' => 40,
			'imageW' => 120,
			'fontSize' =>18,
			'length' =>4,
			);
		$Verify = new \Think\Verify($config);
		$Verify -> entry();
	}
}