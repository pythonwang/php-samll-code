<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Home\Controller\CommonController;
class ListController extends CommonController {
    public function index(){
    	$id = (int) $_GET['id'];
    	$cate = M('cate')->order('sort')->select();
    	$cids = getchildid($cate,$id);
    	$cids[] = $id;
    	$where = array('cid' =>array('IN',$cids),'del' =>0);
    	//分页
    	$total = M('blog')->where($where)->count();
        $per = 10;
        $page = new \Component\Page($total,$per);
        $str = $page->limit;
        $limit = substr($str,5);//把limit字符去掉
        $blog = D('BlogView')->getAll($where,$limit);
        $pagelist =$page->fpage();
        $this->blog = $blog;
        $this->assign('page',$pagelist);
		$this->display();
    }
}