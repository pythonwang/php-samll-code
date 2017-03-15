<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Home\Controller\CommonController;
class ShowController extends CommonController {
    public function index(){
    	$id = (int) $_GET['id'];
    	M('blog')->where(array('id' => $id))->setInc('click');
    	$field = array('title','time','click','content','cid','username');
    	$blog = D('UserView')->field($field)->find($id);
    	$this->blog = $blog;
    	$cid = $this->blog['cid'];
    	$cate = M('cate')->order('sort')->select();
    	$parent = getparent($cate,$cid);
    	$this->parent = $parent;
		$this->display();
    }
}