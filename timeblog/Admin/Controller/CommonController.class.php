<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function _initialize() {
		if (!isset($_SESSION['uid']) || !isset($_SESSION['username'])) {
			redirect(U('Login/index'));
			# code...
		}
	}
}