<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class CategoryController extends CommonController {
	//分类列表视图
	public function index() {
		$cate = M('cate')->order('sort ASC')->select();
		$cate = unlimitedforlevel($cate,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;----');
		$this->cate = $cate;
		$this->display();
	}
	//添加分类视图
	public function addcate() {
		$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
		$this->pid = $pid;
		$this->display();
	}
	//添加分类表单处理
	public function runaddcate() {
		if (M('cate')->add($_POST)) {
			$this->success('添加成功', U('index'));
		}else{
			$this->error('添加失败');
		}
	}
	//排序
	public function sortcate() {
		$db = M('cate');
		foreach ($_POST as $id => $sort) {
			
		$db->where(array('id' => $id))->setField('sort',$sort);
		}
		redirect(U('index'));
	}
}