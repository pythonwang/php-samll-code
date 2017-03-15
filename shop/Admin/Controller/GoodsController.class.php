<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class GoodsController extends CommonController {
	//商品列表
	public function index() {
		    
		    $total = D('GoodsView')->count();
			$per = 7;
			$page = new \Component\Page($total,$per);
			$str = $page->limit;
			$limit = substr($str,5);//把limit字符去掉
			$shop = D('GoodsView')->order('shopid')->limit($limit)->select();
			$pagelist =$page->fpage();
			
			$this->shop = $shop;
			$this->assign('page',$pagelist);
			$this->display();
	}


	//商品添加
	public function add() {
		$shopid = $_GET['shopid'];
		$shop = M('shop')->where(array('shopid' => $shopid))->find();
		$category = M('category')->order('sort ASC')->select();
		$category = unlimitedforlevel($category,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');
		$local = M('locality')->order('sort ASC')->select();
		$local = localforlevel($local,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');

		$this->local = $local;

		$this->cate = $category;
		$this->shop = $shop;
		$this->goods_server = C('goods_server');
		$this->display();
	}
	
	//图片上传//商品添加表单处理
	public function upadd() {

		if (!IS_POST) {
		E('页面不存在');
		# code...
	}
	$config = array(
					'rootPath'   =>  './Uploads/',
					'savePath'   =>'pic/',
					);
				$upload = new \Think\Upload($config);
				$info= $upload -> upload();
				if (!$info) {
					$this->error('错误');
					//dump($upload->getError());
					# code...
					
				}else{
					foreach ($info as $z) {
						
					$bigimg = $z['savepath'].$z['savename'];

					$image = new \Think\Image();
					$srcimg = $upload->rootPath.$bigimg;
					$image->open($srcimg);
					//NO.1
                	$image->thumb(460,280);  // 设置宽高
                // 保存缩略图片
					$smallimg=$z['savepath']."max_".$z['savename'];

					$image->save($upload->rootPath.$smallimg);
					
					//$max =$smalling;
					

					//NO.2
					$image->thumb(310,185);
					$smallimg=$z['savepath']."med_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);
					
					

					//NO.3
					$image->thumb(200,105);
					$smallimg=$z['savepath']."small_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);

					//NO.4
					$image->thumb(90,55);
					$smallimg=$z['savepath']."mini_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);
					
					//$_POST['small'.$k] = $smallimg[$k];
					$aa = $z['savepath']."max_".$z['savename'];
					$bb = $z['savepath']."med_".$z['savename'];
					$cc = $z['savepath']."small_".$z['savename'];
					$dd = $z['savepath']."mini_".$z['savename'];
					
				}
				//goods表数据保存
				$data = array(
					'cid' => $_POST['cid'],
					'lid' => $_POST['lid'],
					'shopid' => $_POST['shopid'],
					'price' => $_POST['price'],
					'old_price' => $_POST['old_price'],
					'main_title' => $_POST['main_title'],
					'sub_title' => $_POST['sub_title'],
					'goods_max_img' => $aa,
					'goods_med_img' => $bb,
					'goods_small_img' => $cc,
					'goods_mini_img' => $dd
					
					);
				
					$gid = M('goods')->add($data);	
					

				//goods_detail表数据保存
				$detail = array(
					'goods_id' => $gid,
					'detail' => $_POST['detail'],
					'goods_server' => serialize($_POST['goods_server'])
					);
				$de = M('goods_detail')->add($detail);
					if ($gid && $de) {
						$this->success('添加商品成功',U('index'));
					}else{
						$this->error('添加商品失败');
					}
				}

	}
	//ueditor图片上传处理
	public function upload() {
		$config = array(
					'rootPath'   =>  './Public/',
					'savePath'   =>'Uploads/image/',
					);
		 $upload = new \Think\Upload($config);
		 $info   =   $upload->upload();
		 if ($info) {
		 	foreach ($info as $z) {
		 		$u='/app/shop/Public/' . $z['savepath'].$z['savename'];

		 	
		 	/*$image = new \Think\Image();
		 	$srcimg = $upload->rootPath.$z['savepath'].$z['savename'];
		 	$image->open($srcimg)->water('./Public/Admin/Images/logo.png',\Think\Image::IMAGE_WATER_SOUTHEAST,100)->save($srcimg);*/
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
	//商品编辑显示
	public function edit() {
		$gid = $_GET['gid'];
			$goods = D('GoodsView')->where(array('gid' => $gid))->find();
			$goods['goods_server'] = unserialize($goods['goods_server']);

			$local = M('locality')->order('sort ASC')->select();
		$local = localforlevel($local,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');
		$category = M('category')->order('sort ASC')->select();
		$category = unlimitedforlevel($category,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--');

		$this->cate = $category;

		$this->local = $local;
			$this->goods = $goods;
			$this->server = C('goods_server');
			$this->display();
		
	}
	//商品编辑表单处理，数据库更新
	public function runedit() {
		
		if (!empty($_FILES['goodsimage']['name'])) {
					
			$config = array(
					'rootPath'   =>  './Uploads/',
					'savePath'   =>'pic/',
					);
				$upload = new \Think\Upload($config);
				$z=$info= $upload -> uploadOne($_FILES['goodsimage']);

				if (!$z) {
					$this->error('错误');
					//dump($upload->getError());
					# code...
				}else{
					
					
					$bigimg = $z['savepath'].$z['savename'];
					
					$image = new \Think\Image();
					$srcimg = $upload->rootPath.$bigimg;
					$image->open($srcimg);
					//NO.1
                	$image->thumb(460,280);  // 设置宽高
                // 保存缩略图片
					$smallimg=$z['savepath']."max_".$z['savename'];

					$image->save($upload->rootPath.$smallimg);
					//$max =$smalling;
					

					//NO.2
					$image->thumb(310,185);
					$smallimg=$z['savepath']."med_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);
					
					

					//NO.3
					$image->thumb(200,100);
					$smallimg=$z['savepath']."small_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);

					//NO.4
					$image->thumb(90,55);
					$smallimg=$z['savepath']."mini_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);
					
					//$_POST['small'.$k] = $smallimg[$k];
					$aa = $z['savepath']."max_".$z['savename'];
					$bb = $z['savepath']."med_".$z['savename'];
					$cc = $z['savepath']."small_".$z['savename'];
					$dd = $z['savepath']."mini_".$z['savename'];
					
				
				//goods表数据保存
				
				$data = array(
					'gid' => $_GET['gid'],
					'cid' => $_POST['cid'],
					'lid' => $_POST['lid'],
					'shopid' => $_POST['shopid'],
					'begin_time' => $_POST['begin_time'],
					'end_time' => $_POST['end_time'],
					'price' => $_POST['price'],
					'old_price' => $_POST['old_price'],
					'main_title' => $_POST['main_title'],
					'sub_title' => $_POST['sub_title'],
					'goods_max_img' => $aa,
					'goods_med_img' => $bb,
					'goods_small_img' => $cc,
					'goods_mini_img' => $dd
					
					);
				//删除本地图片
				
				
					$gid = M('goods')->save($data);	

				
			}
			}else{
					$data = array(
						'gid' => $_GET['gid'],
						'cid' => $_POST['cid'],
						'lid' => $_POST['lid'],
						'shopid' => $_POST['shopid'],
						'begin_time' => $_POST['begin_time'],
						'end_time' => $_POST['end_time'],
						'price' => $_POST['price'],
						'old_price' => $_POST['old_price'],
						'main_title' => $_POST['main_title'],
						'sub_title' => $_POST['sub_title'],
					
					);
				
					$gid = M('goods')->save($data);	
					//删除旧图
						@unlink('./Uploads/' . $_POST['old_img_1']);
						@unlink('./Uploads/' . $_POST['old_img_2']);
						@unlink('./Uploads/' . $_POST['old_img_3']);
						@unlink('./Uploads/' . $_POST['old_img_4']);

				}
				//goods_detail表数据保存
				$detail = array(
					'detail' => $_POST['detail'],
					'goods_server' => serialize($_POST['goods_server'])
					);
				
				$de = M('goods_detail')->where(array('goods_id' => $_GET['gid']))->save($detail);
				
					if ($gid || $de) {

						$this->success('修改商品成功',U('index'));
					}else{
						$this->error('修改商品失败');
					}
				
	}
	//商品删除
	public function del() {
		$gid = $_GET['gid'];
		$de = M('goods_detail')->where(array('goods_id' => $gid))->delete();
		$goods = M('goods')->where(array('gid' => $gid))->delete();
		if ($de && $goods) {
			$this->success('删除成功',U('index'));
			# code...
		}else{
			$this->error('删除失败');
		}
		
	}
}