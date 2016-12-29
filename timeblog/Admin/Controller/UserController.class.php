<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class UserController extends CommonController {
	public function index() {

		$count = M('user')->count();
        $page = new \Think\Page($count,10);
        $limit = $page->firstRow.','.$page->listRows;
        $users = D('UserView')->limit($limit)->select();
		
		$show = $page->show();
		$this->users=$users;
		$this->assign('page',$show);
		

		$this->display();
	}

	//锁定用户
	public function lockUser() {
		$data = array(
			'id' => $_GET['id'],
			'lock' => $_GET['lock']
			);
		$msg = $data['lock'] ? '锁定' : '解锁';
		if (M('user')->save($data)) {
			$this->success($msg . '成功', $_SERVER['HTTP_REFERER']);
			# code...
		}else{
			$this->error($msg . '失败，请重试...');
		}
	}

	//微博用户检索
	public function sechUser() {
		if (isset($_GET['sech']) && isset($_GET['type'])) {
			$where = $_GET['type'] ? array('id' => $_GET['sech']) : array('username' => array('LIKE', '%' . $_GET['sech'] . '%'));
			//$user = D('UserView')->where($where)->select();
			$count = D('UserView')->where($where)->count();
        $page = new \Think\Page($count,10);
        $limit = $page->firstRow.','.$page->listRows;
        $user = D('UserView')->where($where)->limit($limit)->select();
		
		$show = $page->show();
		
		$this->assign('page',$show);
			$this->user = $user ? $user : false;
			# code...
		}

		$this->display();
	}

	public function admin() {
		$admin = M('admin')->select();
		$this->admin = $admin;

		$this->display();

	}

	public function addAdmin() {

		$this->display();
	}

	//锁定后台管理员
	public function lockAdmin() {
		$data = array(
			'id' => $_GET['id'],
			'lock' => $_GET['lock']
			);
		$msg = $data['lock'] ? '锁定' : '解锁';
		if (M('admin')->save($data)) {
			$this->success($msg . '成功', U('admin'));
			# code...
		}else{
			$this->error($msg . '失败，请重试...');
		}
	}

	//后台管理员删除
	public function delAdmin() {
		$id = $_GET['id'];
		if (M('admin')->delete($id)) {
			$this->success('删除成功', U('admin'));
			# code...
		}else{
			$this->error('删除失败,请重试...');
		}
	}
	public function runAddAdmin() {
		if ($_POST['pwd'] !== $_POST['pwded']) {
			$this->error('两次密码不一致');
			# code...
		}
		$data = array(
			'username' => $_POST['username'],
			'password' => $_POST['pwd'],
			'logintime' => time(),
			'loginip' => get_client_ip(),
			'admin' => $_POST['admin']
			);
		$z = M('admin')->add($data);
		if ($z) {
			$this->success('添加成功', U('admin'));
			# code...
		}else{
			$this->error('添加失败，请重试...');
		}
	}
	//修改密码
	public function editPwd() {

		$this->display();
	}
	public function runEditPwd() {
		$db = M('admin');
		$old = $db->where(array('id' => session('uid')))->getField('password');
		if ($old !== $_POST['old']) {
			$this->error('旧密码错误');
			# code...
		}
		if (empty($_POST['pwd']) || empty($_POST['pwded'])){
			$this->error('密码不能为空');
			# code...
		}
		if ($_POST['pwd'] !== $_POST['pwded']) {
			$this->error('两次密码不一致');
			# code...
		}
		$data = array(
			'id' => session('uid'),
			'password' =>$_POST['pwd']
			);
		if ($db->save($data)) {
			$this->success('修改成功', U('Index/copy'));
			# code...
		}else{
			$this->error('修改失败');
		}
	}
}