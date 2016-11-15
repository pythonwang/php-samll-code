<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
	public function showlist() {
		$user = new UserController();
		echo $user->number();
		$this->display();
	}

	public function detail() {
		$this->dispaly();
	}
}