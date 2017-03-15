<?php
namespace Member\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function index() {
		$this->display();
	}

	//登录表单验证
	public function login() {
		if (!IS_POST) {
			E('页面不存在');
		}
		$user = M('user');
		$email= $user->getByEmail($_POST['username']);
		$pwd= $user->getByPassword($_POST['password']);
		$uid =$user->where(array('email' => $_POST['username']))->getField('uid');
		$uname =$user->where(array('email' => $_POST['username']))->getField('uname');
		if (!$email || !$pwd) {
			$this->error('用户名或者密码不正确');
			
		}
		if (!empty($_POST['auto'])) {
			$ip = get_client_ip();
			$value = $uname . '|' . $ip ;
			@setcookie('auto',$value,C('AUTO_LOGIN_TIME'),'/');
			
		}
	    
		session('uid',$uid);

		$db = M('cart');
		//第一次登陆，把session的数据写入数据库
		if (isset($_SESSION['cart']['goods'])) {
				$carts = $_SESSION['cart']['goods'];
				foreach ($carts as $v) {
					$dt = array(
						'user_id' => session('uid'),
						'goods_id' => $v['id'],
						'goods_num' => $v['num']
						);
					$where = array('user_id' => $dt['user_id'],'goods_id' => $dt['goods_id']);
					$cart_id = $db->where($where)->getField('cart_id');
					//有相同商品+1，否则添加新商品
					if ($cart_id) {
						$db->where(array('cart_id' => $cart_id))->setInc('goods_num');
					}else{
						$db->add($dt);
					}
				}
				/*清空session。goods,后面就可以直接商品提交添加数据库*/
				unset($_SESSION['cart']['goods']);
		}
		header('Content-Type:text/html; charset=utf-8');
		redirect(U('Home/Index/index'),2,'登录成功，正在为您跳转...');
	}
	//退出
	public function quit() {
		session_unset();
		session_destroy();
		@setcookie('auto','',time() - 3600,'/');
		$this->success('退出成功',__ROOT__);
	}
}