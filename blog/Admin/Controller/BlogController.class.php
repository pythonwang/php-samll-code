<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class BlogController extends CommonController {
	//博文列表
	public function index() {
		$field = array('del');
		$where = array('del' =>0);
		$blog = D('BlogRelation')->field($field,true)->where($where)->relation(true)->select();
		$this->blog = $blog;
		$this->display();
	}
	//删除/还原到回收站
	public function totrach() {
		$type = (int) $_GET['type'];
		$msg = $type ? '删除' : '还原';
		$update = array(
			'id' => (int) $_GET['id'],
			'del' => $type
			);
		$z = M('blog')->save($update);
		if ($z) {
			$this->success($msg . '成功',U('index'));
		}else{
			$this->error($msg . '失败');
		}
	}
	//回收站
	public function trach() {
		$field = array('del');
		$where = array('del' =>1);
		$blog = D('BlogRelation')->field($field,true)->where($where)->relation(true)->select();
		$this->blog = $blog;
		$this->display('index');
	}
	//彻底删除博文
	public function delete() {
		$id = (int) $_GET['id'];
		$z = M('blog')->delete($id);
		if ($z) {
			M('blogattr')->where(array('bid' => $id))->delete();
			$this->success('删除成功',U('trach'));
		}else{
			$this->error('删除失败');
		}
	}
	public function alldel() {
		$db = M('blog');
		$bid['bid'] = $db->where(array('del' => 1))->getField('id',true);
		dump($bid);
		$z = $db->where(array('del' => 1))->delete();
		if ($z) {
			M('blogattr')->where($bid['bid'])->delete();
			$this->success('清空回收站成功',U('trach'));
		}else{
			$this->error('清空回收站失败',U('trach'));
		}
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
			'click' => (int) $_POST['click'],
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
			$this->success('发布成功',U('index'));
			
		}
		$this->display();
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
}