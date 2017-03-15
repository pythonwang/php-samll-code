<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index() {
		$this->display();
	}
	//显示验证码
	public function verifyImage() {
		$config =array(
			'imageH' => 40,
			'imageW' => 120,
			'fontSize' =>18,
			'length' =>4,
			//'reset' => false
			);
		$verify = new \Think\Verify($config);
		$verify->entry();
	}
	/**
	 * 校验验证码
	 */
	public function checkCode(){
		$data =  array('status'=>false);
		$verify = new \Think\Verify();
		if ($verify->check($_POST['code'])) {
			$data['status'] = true;
		}
		echo json_encode($data);
	}
	//登录
	public function login() {
		if (!IS_POST) {
			E('页面错误');
		}
		$username = $_POST['username'];
		$password = $_POST['password'];
		$where = array('adminname' =>$username,'adminpwd' =>$password);
		$info = M('admin')->where($where)->find();
		if ($info['adminpwd'] != $password) {
			$this->error('登录失败');
		}else{
			session('uname',$username);
			$this->success('登录成功',U('Admin/Index/index'));
		}
	}
	/**
	 * 退出登录
	 */
	public function logout(){
		session_unset();
		session_destroy();
		echo '<literal><script>alert("退出成功");top.location.href="index";</script></literal>';
	}
	
}