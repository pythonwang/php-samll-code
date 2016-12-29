<?php
//后台视图
namespace Admin\Controller;
use Admin\Controller\CommonController;
class IndexController extends CommonController {
	public function index() {


		$this->display();
	}



public function copy() {
	$db = M('user');
	$this->user = $user = $db->count();
	$this->lock = $lock = $db->where(array('lock' => 1))->count();
	$wb = M('weibo');
	$this->weibo = $wb->where(array('isturn' => 0))->count();
	$this->turn = $wb->where(array('isturn' => array('GT', 0)))->count();
	$this->comment = M('comment')->count();

	$this->display();
}
public function loginOut() {
	session_unset();
	session_destroy();
	redirect(U('Login/index'));
}
}