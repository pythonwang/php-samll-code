<?php
namespace Home\Controller;
use Home\Controller\CommonController;
class UserController extends CommonController {
	public function index () {
		$id = $_GET['id'];

		$where = array('uid' => $id);
		$userinfo = M('userinfo')->where($where)->field('truename,face50,face80,style',true)->find();
		if (!$userinfo) {
			header('Content-Type:text/html;Charset=UTF-8');
			redirect(__ROOT__,3,'用户不存在，正在为您跳转至首页...');
			exit();
			# code...
		}
		$this->userinfo = $userinfo;
		//读取用户发布的微博
		//并分页
		$where = array('uid' => $id);
		$count = M('weibo')->where($where)->count();
        $page = new \Think\Page($count,7);
        $limit = $page->firstRow.','.$page->listRows;
		$weibo = D('WeiboView')->getAll($where,$limit);
		$show = $page->show();
		$this->weibo=$weibo;
		$this->assign('page',$show);

		//个人页我的关注
		$where = array('fans' => $id);
		$follow = M('follow')->where($where)->field('follow')->select();
		foreach ($follow as $k => $v) {
			$follow[$k] = $v['follow'];//一维数组
			# code...
		}
		$where = array('uid' => array('IN',$follow));
		$field = array('username','face50' => 'face','uid');
		$follow = M('userinfo')->field($field)->where($where)->limit(8)->select();
		
		//个人页我的粉丝
		$where = array('follow' => $id);
		$fans = M('follow')->where($where)->field('fans')->select();
		foreach ($fans as $k => $v) {
			$fans[$k] = $v['fans'];//一维数组
			# code...
		}
		$where = array('uid' => array('IN',$fans));
		$field = array('username','face50' => 'face','uid');
		$fans = M('userinfo')->field($field)->where($where)->limit(8)->select();
		$this->follow = $follow;
		$this->fans = $fans;
		$this->display();

	}

	//用户关注与粉丝列表
	public function followList() {
		$uid = $_GET['uid'];
		//区分关注与粉丝1是关注，0是粉丝
		$type = $_GET['type'];
		$where = $type ? array('fans' => $uid) : array('follow' => $uid);
		$field = $type ? 'follow' : 'fans';
		$db = M('follow');

		
		$count = $db->where($where)->count();
        $page = new \Think\Page($count,10);
        $limit = $page->firstRow.','.$page->listRows;
		$uids = $db->field($field)->where($where)->limit($limit)->select();
		if ($uids) {//重组为一维数组
			foreach ($uids as $k => $v) {
				$uids[$k] = $type ? $v['follow'] : $v['fans'];
				# code...
			}
			$where = array('uid' => array('IN',$uids));
			$field = array('face50' =>'face', 'username', 'sex', 'location', 'follow', 'fans', 'weibo', 'uid');
			$users = M('userinfo')->where($where)->field($field)->select();
			$this->users = $users;
		}

		$where = array('fans' => session('uid'));
		$follow = $db->field('follow')->where($where)->select();
		if ($follow) {
			foreach ($follow as $k => $v) {
				$follow[$k] = $v['follow'];

				# code...
			}
			# code...
		}
		$where = array('follow' => session('uid'));
		$fans = $db->field('fans')->where($where)->select();
		if ($fans) {
			foreach ($fans as $k => $v) {
				$fans[$k] = $v['fans'];
				# code...
			}
			# code...
		}

		$this->type = $type;
		$this->count = $count;
		$this->follow = $follow;
		$this->fans = $fans;
		$show = $page->show();
		
		$this->assign('page',$show);
		

		$this->display();

	}

	//收藏列表
	public function keep() {

        
		$uid = session('uid');
		$count = M('keep')->where(array('uid' => $uid))->count();

		$page = new \Think\Page($count,7);
		$limit = $page->firstRow.','.$page->listRows;
		$where = array('keep.uid' => $uid);
		$weibo = D('KeepView')->getAll($where,$limit);
		$this->weibo = $weibo;
		$this->page = $page->show();
		
		$this->display('weiboList');
	}


	public function _empty($name) {
		$this->_getUrl($name);
	}

	//取消收藏
	public function cancelKeep() {
		if (!IS_AJAX) {
			E('页面不存在');
			# code...
		}
		$kid = $_POST['kid'];
		$wid = $_POST['wid'];
		if (M('keep')->delete($kid)) {
			M('weibo')->where(array('id' => $wid))->setDec('keep');
			echo 1;
				# code...
			}else{
				echo 0;
			}	
	}

	//私信
	public function letter() {
		$uid = session('uid');
		$count = M('letter')->where(array('uid' => $uid))->count();

		$page = new \Think\Page($count,10);
		$limit = $page->firstRow.','.$page->listRows;
		$where = array('letter.uid' => $uid);
		$letter = D('LetterView')->where($where)->order('time DESC')->limit($limit)->select();
		
		$this->letter = $letter;
		$this->count = $count;
		$this->page = $page->show();
		$this->display();
	}

	//删除私信
	public function delLetter() {
		if (!IS_AJAX) {
			E('页面不存在');
			# code...
		}
		$lid = $_POST['lid'];
		$z = M('letter')->delete($lid);
		if ($z) {
			echo 1;
			# code...
		}else{
			echo 0;
		}
	}

	//私信发送表单处理
	public function letterSend() {
		if (!IS_POST) {
			E('页面不存在');
			# code...
		}
		$name = $_POST['name'];
		$where = array('username' => $name);
		$uid = M('userinfo')->where($where)->getField('uid');
		if (!$uid) {
			$this-> error('用户不存在');
			# code...
		}
		$data = array(
			'from' => session('uid'),
			'content' => $_POST['content'],
			'time' => time(),
			'uid' => $uid 

			);
		$z = M('letter')->add($data);
		if ($z) {
			$this->success('私信已发送', U('letter'));
			# code...
		}else{
			$this->error('发送失败，请重试...');
		}
	}

	//评论列表
	public function comment() {
		$where = array('uid' => session('uid'));
		$count = M('comment')->where($where)->count();

		$page = new \Think\Page($count,10);
		$limit = $page->firstRow.','.$page->listRows;
		$comment = D('CommentView')->where($where)->limit($limit)->order('time DESC')->select();
		$this->count = $count;
		$this->page = $page->show();
		$this->comment = $comment;
		$this->display();
	}

	//评论列表评论回复
	public function reply() {
		if (!IS_AJAX) {
			E('页面不存在');
			# code...
		}
		$data = array(
			'content' => $_POST['content'],
			'time' => time(),
			'uid' => session('uid'),
			'wid' => $_POST['wid']
			);
		$z = M('comment')->add($data);
		if ($z) {
			M('weibo')->where(array('id' => $wid))->setInc('comment');
			echo 1;
			# code...
		}else{
			echo 0;
		}
	}
	//评论列表删除评论
	public function delComment() {
		if (!IS_AJAX) {
			E('页面不存在');
			# code...
		}
		$cid = $_POST['cid'];
		$wid = $_POST['wid'];
		$z = M('comment')->delete($cid);
		if ($z) {
			M('weibo')->where(array('id' => $wid))->setDec('comment');
			echo 1;
			# code...
		}else{
			echo 0;
		}
	}

	//@提到我的
	public function atme() {
		$where = array('uid' => session('uid'));
		$wid = M('atme')->where($where)->field('wid')->select();
			if ($wid) {
				foreach ($wid as $k => $v) {
					$wid[$k] = $v['wid'];
					# code...
				}
				
				# code...
			}


		$total = count($wid);
		$per = 10;
		$page = new \Component\Page($total,$per);
		$str = $page->limit;
		$limit = substr($str,5);//把limit字符去掉
		
		$where = array('id' => array('IN', $wid));
		
		$weibo = D('WeiboView')->getAll($where,$limit);
		
		
		$pagelist =$page->fpage();

		$this->count = $total;
		$this->weibo = $weibo ? $weibo : false;
		$this->atme = 1;
		$this->assign('page',$pagelist);
		$this->display('weiboList');

			
	}
	public function _getUrl($name) {
		$name = htmlspecialchars($name);
		$where = array('username' => $name);
		$uid = M('userinfo')->where($where)->getField('uid');

		if (!$uid) {
			redirect(U('Index/index'));
		} else {
			redirect(U('/' . $uid));
		}
	}
}

	


