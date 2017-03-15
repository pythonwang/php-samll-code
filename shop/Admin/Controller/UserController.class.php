<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class UserController extends CommonController {
	public function index() {
		//分页
			$per = 7;
			$total = D('UserView')->count();
			$page = new \Component\Page($total,$per);
			$str = $page->limit;
			$limit = substr($str,5);//把limit字符去掉
			$user = D('UserView')->limit($limit)->select();
			$pagelist =$page->fpage();
			$this->user = $user;
			$this->assign('page',$pagelist);
			$this->display();
	}
	//删除用户
	public function deluser() {
		$uid = $_GET['uid'];
		$a = M('collect')->where(array('user_id' => $uid))->delete();
		$b = M('cart')->where(array('user_id' => $uid))->delete();
		$c = M('order')->where(array('user_id' => $uid))->delete();
		$d = M('userinfo')->where(array('user_id' => $uid))->delete();
		$e = M('user_address')->where(array('user_id' => $uid))->delete();
		if ($a || $b || $c || $d || $e) {
			$this->success('删除成功',U('index'));
		}else{
			$this->error('删除失败');
		}
	}
}