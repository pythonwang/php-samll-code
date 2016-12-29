<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
class LoginController extends Controller {
	public function index() {

		$this->display();

	}

	public function login() {
		
		$user = D('User');
		$ac = $_POST['account'];
		$pwd = $_POST['password'];
		$z= $user->getByAccount($ac);
		$y= $user->getByPassword($pwd);
		$id =$user->getFieldByAccount($ac,'id');
		$lock = $user->getFieldByAccount($ac,'lock');
		$account =$user->getFieldByAccount($ac,'account');
		if (!$z || !$y) {
			$this->error('用户名或者密码不正确');
			
		}
		if ($lock) {
			$this->error('用户被锁定');
			# code...
		}
		if (isset($_POST['auto'])) {
			$ip = get_client_ip();
			$value = $account . '|' . $ip;
			$value = encryption($value);
			@setcookie('auto',$value,C('AUTO_LOGIN_TIME'),'/');
			
		}
	    
		session('uid',$id);
		header('Content-Type:text/html; charset=utf-8');
		redirect(U('Index/index'),3,'登录成功，正在为您跳转...');
		
	}

	public function register() {
		
		$this->display();
	

	}

//注册表单处理
	public function runRegis() {
		if (!IS_POST) {

			E('页面不存在');
		}
		

	if ($_POST['password'] !=$_POST['repassword']) {
		$this->error('两次密码不一致');

		# code...
	}
	$user = D('User');
	if (!empty($_POST)) {
    		$data =array(
    		'account' => $_POST['account'],
    		'password' => $_POST['password'],
    		'registime' => $_SERVER['REQUEST_TIME'],
    	    'userinfo' => array(
    		'username' => $_POST['username']
    		),

			);
    		
    		
    		$rst =$user->relation(true)->add($data);//关联模型插入数据库，create方法过滤字段，不适用

    		if ($rst) {
    			session('uid',$rst);
    			header('Content-Type:text/html; charset=utf-8');
    			
    			redirect(__APP__,3,'注册成功，正在为您跳转....');
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
			'fontSize' =>14,
			'length' =>4,
			//'reset' => false,


			);
		$verify = new \Think\Verify($config);
		$verify->entry();
	}
	public function checkAccount() {
		if (!IS_AJAX) {
			E('页面不存在');
			# code...
		}
		$account = I('post.account');
		$where = array('account' => $account);
		$user = D('User')->where($where)->getField('id');
		if ($user) {
			echo 'false';
			# code...
		}else{
			echo 'true';
		}
	}
	public function checkUsername() {
		if (!IS_AJAX) {
			E('页面不存在');
			# code...
		}
		$username = I('post.username');
		$where = array('username' => $username);
		$user = D('Userinfo')->where($where)->getField('id');
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
			# code...
		}
		$verify2 = I('post.verify');

			$verify = new \Think\Verify();
			
			if (!$verify->check($verify2)) {
				echo 'false';			# code...

		  }else{
			    echo 'true';
		}
}
}