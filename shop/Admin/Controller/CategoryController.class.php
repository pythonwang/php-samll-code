<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class CategoryController extends CommonController {
	public function index() {
		$category = M('category')->order('sort ASC')->select();
		$category = unlimitedforlevel($category,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');

		$this->cate = $category;
		$this->display();
	}
	public function add() {
		$category = M('category')->order('sort ASC')->select();
		$category = unlimitedforlevel($category,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');
		$cid = isset($_GET['cid']) ? $_GET['cid'] : 0;
		$parents = M('category')->where(array('cid' => $cid))->field('cname,cid')->select();
		
		$this->cate = $category;
		$this->parents = $parents;
		$this->display();
			
	}
	

	public function addup() {
		
		$data = array(
			'cname' => $_POST['cname'],
			'title' => $_POST['title'],
			'keywords' => $_POST['keywords'],
			'description' => $_POST['description'],
			'sort' => $_POST['sort'],
			'display' => $_POST['display'],
			'pid' => $_POST['pid']

			);
		$z = M('category')->add($data);
		if ($z) {
			$this->success('添加成功',U('index'));
			# code...
		}else{
			$this->error('添加失败!');
		}
	}

	public function edit() {
		$cid = $_GET['cid'];
		$edcate = M('category')->where(array('cid' => $cid))->find();
		$parents = M('category')->where(array('cid' => $cid))->select();
		$parents = getparent($parents,$cid);
		
		$category = M('category')->order('sort ASC')->select();
		$category = unlimitedforlevel($category,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');

		$this->cate = $category;
		$this->edcate = $edcate;
		$this->parents = $parents;
		
			$data = array(
				'cname' => $_POST['cname'],
				'title' => $_POST['title'],
				'keywords' => $_POST['keywords'],
				'description' => $_POST['description'],
				'sort' => $_POST['sort'],
				'display' => $_POST['display'],
				'pid' => $_POST['pid']

			);

			if(IS_POST) {
			$z = M('category')->where(array('cid' => $cid))->save($data);
			if ($z) {
				$this->success('修改成功',U('index'));
				# code...
			}else{
				$this->error('修改失败!');
			}
	}
		$this->display();

	}
	public function del() {
		$cid = $_GET['cid'];
		if(M('category')->where(array('pid' => $cid))->count()) {
			$this->error('请先删除子分类');
		}
		$z = M('category')->where(array('cid' => $cid))->delete();
        if ($z) {
        	$this->success('删除成功',U('index'));
        	# code...
        }else{
        	$this->error('删除失败');
        }
		
	}
}