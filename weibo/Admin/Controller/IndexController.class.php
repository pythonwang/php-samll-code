<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Component\AdminController;
class IndexController extends AdminController {
    public function index(){
    	$this->display();
	
    	
    }


public function head() {
	$this->display();
}

public function left() {
	$sql = "select * from sw_manager where mg_id=".$_SESSION['mg_id'];
	$minfo = D()->query($sql);
	$role_id = $minfo[0]['mg_role_id'];

	$sql2 = "select * from sw_role where role_id=".$role_id;
	$rinfo = D()->query($sql2);
	$auth_ids = $rinfo[0]['role_auth_ids'];


	$sql3 = "select * from sw_auth where auth_level=0 ";
	if ($_SESSION['mg_id'] !=1) {
		$sql3 .="and auth_id in ($auth_ids)";
		# code...
	}
	$p_info = D()->query($sql3);

	$sql3 = "select * from sw_auth where auth_level=1 ";
	if ($_SESSION['mg_id'] !=1) {
		$sql3 .="and auth_id in ($auth_ids)";
		# code...
	}

		# code...
	
	$s_info = D()->query($sql3);



	$this -> assign('pauth_info',$p_info);
	$this -> assign('sauth_info',$s_info);



	$this->display();
}

public function right() {
	$this->display();
}




}