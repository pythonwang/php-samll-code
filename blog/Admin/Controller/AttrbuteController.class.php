<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class AttrbuteController extends CommonController {
	public function index() {
		$this->attr =M('attr')->select();
		$this->display();
	}
	//添加属性视图
	public function addattr() {
		$this->display();
	}
	//添加属性表单处理
	public function runattr() {
		if (M('attr')->add($_POST)) {
			$this->success('添加成功',U('index'));
		}else{
			$this->error('添加失败');
		}
	}
}