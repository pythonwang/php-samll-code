<?php
namespace Component;
use Think\Controller;

class AdminController extends Controller {

	public function __construct() {

		parent::__construct();


		$now_ac = CONTROLLER_NAME."-".ACTION_NAME;
		



		$sql = "select role_auth_ac from sw_manager a join sw_role b on a.mg_role_id=b.role_id where a.mg_id=".$_SESSION['mg_id'];

		$auth_ac = D()->query($sql);
		$auth_ac = $auth_ac[0]['role_auth_ac'];
		$allow_ac = array('Index-left','Index-right','Index-head','Index-index','Manager-login');

		if (!in_array($now_ac,$allow_ac) && $_SESSION['mg_id'] !=1 && strpos($auth_ac,$now_ac) ===false) {
			$this->error('没有权限访问',U("Index/right"));
			# code...
		}
		
	}
}