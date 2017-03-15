<?php
//我的个人博客处理
namespace Home\Controller;
use Home\Controller\CommonController;
class MblogController extends CommonController {
	//博文列表
	public function index() {
		$field = array('del');
		$where = array('del' =>0);
		$blog = D('BlogRelation')->field($field,true)->where($where)->relation(true)->select();
		$this->blog = $blog;
		$this->display();
	}
	
	//添加博文
	public function blog() {
		$cate = M('cate')->order('sort')->select();
		$cate = unlimitedforlevel($cate,'&nbsp;&nbsp;&nbsp;&nbsp;--');

		$this->attr = M('attr')->select();
		$this->cate = $cate;
		$this->display();
	}
	//添加博文表单处理
	public function addblog() {
		$data = array(
			'title' => $_POST['title'],
			'content' => $_POST['content'],
			'summary' => $_POST['summary'],
			'time' => time(),
			'uid' => session('uid'),
			'cid' => (int) $_POST['cid'],
			);
		$bid = M('blog')->add($data);
		if ($bid) {
			if (isset($_POST['aid'])) {
				$sql = 'INSERT INTO `' . C('DB_PREFIX') . 'blogattr` (bid, aid) VALUES';
				foreach ($_POST['aid'] as $v) {
					$sql .='(' . $bid . ',' . $v . '),';
				}
				$sql = rtrim($sql,',');
				M('blogattr')->query($sql);
			}
			$this->success('发布成功',U('myshow'));
			
		}
	
	}
	
	//编辑图片上传处理
	public function upload() {
		$config = array(
					'rootPath'   =>  './Public/',
					'savePath'   =>'Uploads/image/',
					);
		 $upload = new \Think\Upload($config);
		 $info   =   $upload->upload();
		 if ($info) {
		 	foreach ($info as $z) {
		 		$u='/app/blog/Public/' . $z['savepath'].$z['savename'];

		 	
		 	$image = new \Think\Image();
		 	$srcimg = $upload->rootPath.$z['savepath'].$z['savename'];
		 	$image->open($srcimg)->water('./Public/Admin/Images/logo.png',\Think\Image::IMAGE_WATER_SOUTHEAST,100)->save($srcimg);
		 }
		 	echo json_encode(array(
		 		'url' => $u, //$upload->rootPath.$info['saveath'].$info['savename'],
		 		'title' => htmlspecialchars($_POST['pictitle'],ENT_QUOTES),
		 		'original' => $info['name'],
		 		'state' => 'SUCCESS',
		 		'type'=>$info['ext'],
                'size'=>$info['size']
		 		));
		 }else{
		 	echo json_encode(array(
		 		'state' => $upload->getErrorMsg()
		 		));
		 	
		 }

	}
	//显示我的博客列表
	public function myshow() {
		/*$id = M('blog')->where(array('uid' =>session('uid')))->getField('id',true);//一维数组；
		dump($id);
		$cid = M('blog')->where(array('id' =>array('IN',$id)))->getField('cid',true);
		echo M('blog')->getlastsql();
		dump($cid);
    	$where =array('cid' =>array('IN',$cid),'del' =>0); */
    	//分页
    	$where = array('uid' =>session('uid'), 'del' =>0);
    	//回收站数目显示
    	$this->count = $count = M('blog')->where(array('uid' =>session('uid'), 'del' =>1))->count();
    	$total = M('blog')->where($where)->count();
        $per = 4;
        $page = new \Component\Page($total,$per);
        $str = $page->limit;
        $limit = substr($str,5);//把limit字符去掉
        $blog = D('BlogView')->getAll($where,$limit);
        
        $pagelist =$page->fpage();
        $this->blog = $blog;
        $this->assign('page',$pagelist);
		$this->display();
	}
	 //异步删除博客放入回收站
    public function delblog() {
        if (!IS_POST) {
            E('页面不存在');
        }
        
        $update = array(
        	'id' => $_POST['did'],
        	'del' => 1
        	);

        if (M('blog')->save($update)) {
            /*$img = $db->where(array('wid' => $wid))->find();
            if ($img) {
                $db->delete($img['id']);//删除微博和文件图片
                @unlink('./Uploads/' . $img['mini']);
                @unlink('./Uploads/' . $img['medium']);
                @unlink('./Uploads/' . $img['max']);
                # code...
            }
            M('userinfo')->where(array('uid' => session('uid')))->setDec('weibo');
            M('comment')->where(array('wid' => $wid))->delete();*/
            echo 1;//传到js判断
            # code...
        }else{
            echo 0;
        }
    }
    //修改博文
    public function change() {
    	
    		$id = (int) $_GET['id'];
    		$blog = M('blog')->where(array('id' =>$id))->select();
    		//当前用户所属分类
    		$cid = M('blog')->where(array('id' =>$id))->getField('cid');
    		$this->kind = M('cate')->where((array('id' =>$cid)))->select();
    		$this->cid = $cid;
    		//所有分类选项，无限极分类
    		$cate = M('cate')->order('sort')->select();
		    $cate = unlimitedforlevel($cate,'&nbsp;&nbsp;&nbsp;&nbsp;--');
		    //个人attr分类
		    $aid = M('blogattr')->where(array('bid' =>$id))->getField('aid');
		    $this->myattr = M('attr')->where(array('id' =>$aid))->select();
		    $this->id = $id;
			$this->attr = M('attr')->where(array('id' => array('NEQ',$aid)))->select();
			$this->cate = $cate;
    		$this->blog = $blog;
    		$this->display();
    }
    //添加博文表单处理
	public function upblog() {
		$data = array(
			'id' => $_GET['id'],
			'title' => $_POST['title'],
			'content' => $_POST['content'],
			'summary' => $_POST['summary'],
			'time' => time(),
			'cid' => (int) $_POST['cid']
			);
		$bid = M('blog')->save($data);
		if ($bid) {
			if (isset($_POST['aid'])) {
				$bat = array(
					'bid' => $_GET['id'],
					'aid' => $_POST['aid']
					);
				M('blogattr')->where(array('bid'=>$_GET['id']))->save($bat);
			}
			$this->success('博客修改成功',U('myshow'));
			
		}else{
			$this->error('博客修改失败');
		}
	
	}
    //回收站列表
    public function trash() {
    	$field = array('del');
		$where = array('uid' =>session('uid'), 'del' =>1);
		$blog = D('BlogRelation')->field($field,true)->where($where)->relation(true)->select();
		$this->blog = $blog;
		
    	$this->display();
    }
    //回收站彻底删除博文
	public function delete() {
		$id = (int) $_GET['id'];
		$z = M('blog')->delete($id);
		if ($z) {
			M('blogattr')->where(array('bid' => $id))->delete();
			$this->success('删除成功',U('trash'));
		}else{
			$this->error('删除失败');
		}
	}
	//回收站还原
	public function totrach() {
		$update = array(
			'id' => (int) $_GET['id'],
			'del' => 0
			);
		$z = M('blog')->save($update);
		if ($z) {
			$this->success('还原成功');
		}else{
			$this->error('还原失败');
		}
	}
	//清空回收站
	public function alldel() {
		$db = M('blog');
		$bid = $db->where(array('del' => 1, 'uid' =>session('uid')))->getField('id',true);
		$z = $db->where(array('del' => 1, 'uid' =>session('uid')))->delete();
		if ($z) {
			M('blogattr')->where(array('bid' =>array('IN',$bid)))->delete();
			
			$this->success('清空回收站成功');
		}else{
			$this->error('清空回收站失败');
		}
	}
    public function logout() {
		session_unset();
		session_destroy();
		$this->redirect('Login/index');
	}
}