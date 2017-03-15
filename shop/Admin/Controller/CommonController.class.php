<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function _initialize() {
		if (!isset($_SESSION['uname'])) {
			$this->error('请登录！',U('Admin/Login/index'));
		}
	}
}