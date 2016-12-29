<?php
namespace Home\Controller;
use Home\Controller\CommonController;
class UserSettingController extends CommonController {
	//用户基本信息设置
	public function index() {
		$where = array('uid'=>session('uid'));
		$file = array('username','truename','sex','location','constellation','intro','face180');
		$user = D('userinfo')->field($file)->where($where)->find();
		$this->assign('user',$user);
		$this->display();
	}
	//修改用户基本信息
	public function editBasic() {
		if (!IS_POST) {
			E('页面不存在');
			# code...
		}
		
		$data=array(
			'username' => $_POST['nickname'],
			'truename' => $_POST['truename'],
			'sex' => (int) $_POST['sex'],
			'location' => $_POST['province'] .' '. $_POST['city'],
			'constellation' => $_POST['night'],
			'intro' => $_POST['intro'],
			);
		$where = array('uid' => session('uid'));
		
		$user=D('userinfo');
		$z=$user-> where($where)->save($data);//必须id主键才能自动成功
		
		if ($z !==false) {
			$this->success('修改成功',U('index'));
			# code...
		}else{
			$this->error('修改失败');
		}
		
	
	}

	public function editFace() {
		if (!IS_POST) {
			E('页面不存在');
			# code...
		}
		$usinfo = M('userinfo');
		$where = array('uid' => session('uid'));
		$field = array('face50','face80','face180');
			    
		$usinfo->where($where)->save($_POST);
		if ($usinfo !==false) {
				$this->success('修改成功',U('index'));
			     				     	
			     }else{
			     	echo '上传失败，请重试...';
			     }


				
		
	}
	public function editPwd() {
		if (!IS_POST) {
			E('页面不存在');
			# code...
		}//若提交不了，是novalidator校验失败，点击没有反应，可能账号输错
		//dump($_POST);
		$db=D('User');
		$where=array('id' => session('uid'));
		$old = $db->where($where)->getField('password');
		if ($old !== $_POST['old']) {
		       $this->error('旧密码错误');			# code...
		}
		if ($_POST['new'] !== $_POST['newed']) {
			$this->error('两次密码不一致');
			# code...
		}
		$newpwd = $_POST['new'];
		$data = array (
			'id' => session('uid'),
			'password' => $newpwd,
		);
		$z = $db->save($data);
		if ($z) {
			$this->success('修改成功',U('index'));
			# code...
		}else{
			$this->error('修改失败，请返回...');
		}
	}

}