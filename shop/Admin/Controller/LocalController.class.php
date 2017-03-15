<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class LocalController extends CommonController {
	//地区列表
	public function index() {
		$local = M('locality')->order('sort ASC')->select();
		$local = localforlevel($local,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');

		$this->local = $local;
		$this->display();
	}
   //添加地区
	public function add() {
		$local = M('locality')->order('sort ASC')->select();
		$local = localforlevel($local,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');
		$lid = isset($_GET['lid']) ? $_GET['lid'] : 0;
		$parents = M('locality')->where(array('lid' => $lid))->field('lname,lid')->select();
		
		$this->local = $local;
		$this->parents = $parents;
		$this->display();
	}
	//处理添加地区表单
	public function runadd() {
		$data = array(
			'lname' => $_POST['lname'],
			'sort' => $_POST['sort'],
			'display' => $_POST['display'],
			'pid' => $_POST['pid']
			);
		
		$z = M('locality')->add($data);
		
		if ($z) {
			$this->success('添加成功',U('index'));
			
		}else{
			$this->error('添加失败');
		}
	}
//地区列表编辑
	public function edit() {
		$lid = $_GET['lid'];
		$edlocal = M('locality')->where(array('lid' => $lid))->find();
		$parents = M('locality')->where(array('lid' => $lid))->select();
		$parents = localparent($parents,$lid);
		
		$local = M('locality')->order('sort ASC')->select();
		$local = localforlevel($local,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');

		$this->local = $local;
		$this->edlocal = $edlocal;
		$this->parents = $parents;
		
			$data = array(
				'lname' => $_POST['lname'],
				'sort' => $_POST['sort'],
				'display' => $_POST['display'],
				'pid' => $_POST['pid']
			);

			if(IS_POST) {
			$z = M('locality')->where(array('lid' => $lid))->save($data);
			if ($z) {
				$this->success('修改成功',U('index'));
				# code...
			}else{
				$this->error('修改失败!');
			}
	}
		$this->display();

	}
	//地区删除
	public function del() {
		$lid = $_GET['lid'];
		if(M('locality')->where(array('pid' => $lid))->count()) {
			$this->error('请先删除子分类');
		}
		$z = M('locality')->where(array('lid' => $lid))->delete();
        if ($z) {
        	$this->success('删除成功',U('index'));
        	# code...
        }else{
        	$this->error('删除失败');
        }
		
	}

}