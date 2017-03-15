<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function _initialize() {
		if (!isset($_SESSION['uid']) || $_SESSION['username'] =='') {
			$this->redirect('Login/index');
			# code...
		}
	}
}