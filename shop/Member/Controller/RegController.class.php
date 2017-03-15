<?php
namespace Member\Controller;
use Think\Controller;
class RegController extends Controller {
	public function index() {
		$this->setnav();
		$this->display();
	}
	
	//注册表单处理
	public function runRegis() {
		if (!IS_POST) {
			E('页面不存在');
		}
	if ($_POST['password'] !=$_POST['repassword']) {
		$this->error('两次密码不一致');
	}
	$user = M('user');
	if (!empty($_POST)) {
    		$data =array(
	    		'email' => $_POST['account'],
	    		'password' => $_POST['password'],
	    		'registime' => $_SERVER['REQUEST_TIME'],
	    		'uname' => $_POST['username']
			);
    		$rst =$user->add($data);
    		if ($rst) {
    			header('Content-Type:text/html; charset=utf-8');
    			
    			redirect(U('Login/index'),3,'注册成功，正在为您跳转....');
    			# code...
    		}else{
    			$this->error('注册失败');
    		}
	}
}
	
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
	public function checkAccount() {
		if (!IS_AJAX) {
			E('页面不存在');
		}
		$account = I('post.account');
		$where = array('email' => $account);
		$user = M('user')->where($where)->getField('id');
		if ($user) {
			echo 'false';
		}else{
			echo 'true';
		}
	}
	public function checkUsername() {
		if (!IS_AJAX) {
			E('页面不存在');
		}
		$username = I('post.username');
		$where = array('uname' => $username);
		$user = M('user')->where($where)->getField('id');
		if ($user) {
			echo 'false';
			# code...
		}else{
			echo 'true';
		}

	}
	public function checkVerify() {
		if (!IS_AJAX) {
			E('页面不存在');
		}
		$verify2 = I('post.verify');

			$verify = new \Think\Verify();
			
			if (!$verify->check($verify2)) {
				echo 'false';			
		  }else{
			    echo 'true';
		}
}
public function setnav() {
		$nav = M('category')->field('cid,cname')->where(array('pid' => 0, 'display' => 1))->order('sort')->select();
		$this->nav = $nav;
	}
}