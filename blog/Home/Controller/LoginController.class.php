<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index() {
		$this->display();
	}
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
		redirect(U('/'));
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
		
	
	public function register() {
		$this->display();

	}
	public function runreg() {
		if (!IS_POST) {
			E('页面不存在');
		}
		$db = M('user');
		$user = $db->getField('username');
		
		if ($user == $_POST['username']) {
			$this->error('用户名已存在，请重新填写');
		}
		$data = array(
			'username' => $_POST['username'],
			'password' => md5($_POST['password']),
			'logintime' => time(),
			'loginip' => get_client_ip()
			);
		$z = $db->add($data);
		if ($z) {
			$this->success('注册成功，请登录博客',U('index'));
		}else{
			$this->error('注册失败，请重新注册');
		}
	}
}