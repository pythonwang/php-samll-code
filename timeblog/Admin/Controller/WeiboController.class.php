<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class WeiboController extends CommonController {
	public function index() {
		$where = array('isturn' => 0);
		$count = M('weibo')->where($where)->count();
        $page = new \Think\Page($count,10);
        $limit = $page->firstRow.','.$page->listRows;
        $weibo = D('WeiboView')->where($where)->limit($limit)->order('time DESC')->select();
        
		$show = $page->show();
		$this->weibo=$weibo;
		$this->assign('page',$show);
		
		$this->display();
	}

	//删除微博
	public function delWeibo() {
		$id = $_GET['id'];
		$uid = $_GET['uid'];

		$z = D('WeiboRelation')->relation(true)->delete($id);
		if ($z) {
			M('userinfo')->where(array('uid' =>$uid))->setDec('weibo');
			$this->success('删除成功', U('index'));
			# code...
		}else{
			$this->error('删除失败，请重试...');
		}
	}

	//转发微博列表
	public function turn() {
		$where = array('isturn' =>array('GT', 0));
		$count = M('weibo')->where($where)->count();
        $page = new \Think\Page($count,10);
        $limit = $page->firstRow.','.$page->listRows;
        $db = D('WeiboView');
        unset($db->viewFields['picture']);
        $turn = $db->where($where)->limit($limit)->order('time DESC')->select();
        
		$show = $page->show();
		$this->turn=$turn;
		$this->assign('page',$show);
		
		$this->display();

	}

	//微博检索
	public function sechWeibo() {
		if (isset($_GET['sech'])) {
			$where = array('content' => array('LIKE', '%' . $_GET['sech'] . '%'));
			
			$count = D('WeiboView')->where($where)->count();
        $page = new \Think\Page($count,10);
        $limit = $page->firstRow.','.$page->listRows;
        $weibo = D('WeiboView')->where($where)->limit($limit)->order('time DESC')->select();
		
		$show = $page->show();
		
		$this->assign('page',$show);
			$this->weibo = $weibo ? $weibo : false;
			# code...
		}

		$this->display();
	}

	public function comment() {
		$count = M('comment')->count();
        $page = new \Think\Page($count,20);
        $limit = $page->firstRow.','.$page->listRows;
        $comment = D('CommentView')->limit($limit)->order('time DESC')->select();
		$show = $page->show();
		
		$this->assign('page',$show);
		$this->comment = $comment ? $comment : false;
		

		$this->display();
	}

	//delete comment
	public function delComment() {
		$id = $_GET['id'];
		$wid = $_GET['wid'];
		$z = M('comment')->delete($id);
		if ($z) {
			M('weibo')->where(array('id' => $wid))->setDec('comment');
			$this->success('删除成功', $_SERVER['HTTP_REFERER']);
			# code...
		}else{
			$this->error('删除失败，请重试...');
		}
	}

	//search comment
	public function sechComment() {
		if (isset($_GET['sech'])) {
			$where = array('content' => array('LIKE', '%' . $_GET['sech'] . '%'));
			$count = M('comment')->where($where)->count();
            $page = new \Think\Page($count,20);
            $limit = $page->firstRow.','.$page->listRows;
			$comment = D('CommentView')->where($where)->limit($limit)->order('time DESC')->select();
			$show = $page->show();
		
		$this->assign('page',$show);
			$this->comment = $comment ? $comment : false;
		}
		$this->display();

	}
}
