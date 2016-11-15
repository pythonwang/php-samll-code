<?php
namespace Admin\Controller;
use Component\AdminController;
class RoleController extends AdminController {
	public function showlist() {
		$info = D('role')->select();
		$this->assign('info',$info);

		$this->display();
	}

	public function distribute($role_id) {
		if (!empty($_POST)) {
			
			$role = new \Model\RoleModel();
			$z = $role -> saveAuth($_POST['authname'],$role_id);
			if ($z) {
				$this->success('分配权限成功!',U('showlist'));
				# code...
			}else{
				$this->error('分配权限失败!',U('showlist'));
			}
			# code...
		}else{
		$rinfo = D('role')->getByRole_id($role_id);
		$this->assign('role_name',$rinfo['role_name']);

		$pauth_info = D('Auth')->where('auth_level=0')->select();
		$sauth_info = D('Auth')->where('auth_level=1')->select();
		$tauth_info = D('Auth')->where('auth_level=2')->select();

		$auth_ids_arr = explode(',',$rinfo['role_auth_ids']);
		$this->assign('auth_ids_arr',$auth_ids_arr);
		$this->assign('pauth_info',$pauth_info);
		$this->assign('sauth_info',$sauth_info);
		$this->assign('tauth_info',$tauth_info);
		/*foreach ($pauth_info as $k => $v) {
			dump($v['auth_id']);
			# code...
		}
		foreach ($sauth_info as $k => $v) {
			echo '----------------------';
			dump($v['auth_pid']);
			# code...

		}
*/
		
		$this->display();
	}
}
}