<?php
//后台登录
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index() {


		$this->display();
	}

	public function login() {
		if (!IS_POST) {
			E('页面不存在');
			# code...
		}
		$verify = new \Think\Verify();
		if (!$verify->check($_POST['verify'])) {
				$this->error("验证码错误");

	}
	$name = $_POST['uname'];
	$pwd = $_POST['pwd'];
	$db = M('admin');
	$user = $db->where(array('username' =>$name))->find();
	if (!$user || $user['password'] !==$pwd) {
		$this->error('账号或密码错误');
	}
	if ($user['lock']) {
		$this->error('账号被锁定');
		# code...
	}
	$data = array(
		'id' => $user['id'],
		'logintime' => time(),
		'loginip' => get_client_ip()

		);
	$db->save($data);
	session('uid', $user['id']);
	session('username', $user['username']);
	session('logintime', date('Y-m-d H:i',$user['logintime']));
	session('now', date('Y-m-d H:i', time()));
	session('loginip', $user['loginip']);
	session('admin', $user['admin']);
	$this->success('正在登陆...', U('Index/index'));

}
	public function verifyImage() {
		$config =array(
			'imageH' => 40,
			'imageW' => 90,
			'fontSize' =>14,
			'length' =>4,
			//'reset' => false,


			);
		$verify = new \Think\Verify($config);
		$verify->entry();
	}


}