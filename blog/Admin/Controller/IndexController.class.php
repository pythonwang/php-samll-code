<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class IndexController extends CommonController {
	public function index() {
		$this->display();
	}
	public function logout() {
		session_unset();
		session_destroy();
		$this->redirect('Admin/Login/index');
	}
}