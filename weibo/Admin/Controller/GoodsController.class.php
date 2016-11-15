<?php
namespace Admin\Controller;
use Component\AdminController;
class GoodsController extends AdminController {

	public function showlist() {


		$goods = D('Goods');

		$total = $goods->count();
		$per = 7;

		$page = new \Component\Page($total,$per);
		$sql = "select * from sw_goods ".$page->limit;
		$info = $goods->query($sql);


		$pagelist =$page->fpage();

		
		//foreach ($info as $k => $v) {
			//echo $v['goods_name'].'<br />';
			# code...
		$this->assign('info',$info);
		$this->assign('pagelist',$pagelist);
		
		$this->display();
	}

	public function add() {

/*
		$goods = D('Goods');
		$goods->goods_name = 'htc';
		$goods->goods_price = 3000;
		$rst = $goods->add();
		if ($rst > 0) {
			echo "success";
			# code...
		}
*/
		$goods = D('Goods');

		if (!empty($_POST)) {
			if (!empty($_FILES)) {
				$config = array(
					'rootPath'   =>  './Public/',
					'savePath'   =>'upload/',


					);
				$upload = new \Think\Upload($config);
				$z = $upload -> uploadOne($_FILES['goods_image']);
				if (!$z) {
					dump($upload->getError());
					# code...
				}else{
					$bigimg = $z['savepath'].$z['savename'];
					$_POST['goods_big_img'] = $bigimg;

					$image = new \Think\Image();
					$srcimg = $upload->rootPath.$bigimg;
					$image->open($srcimg);
					$image->thumb(150,150);
					$smallimg=$z['savepath']."small_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);
					$_POST['goods_small_img'] = $smallimg;
					dump($_POST['goods_small_img']);
				}

				# code...
			}


			$ar = $_POST;
			$goods->add($ar);
			# code...
		}else{
			
		}
$this->display();
		
	}

	public function upd($goods_id) {
		$goods = D('Goods');
		if (!empty($_POST)) {
			$goods -> create();
			$rst = $goods->save();
			if ($rst) {
				echo "ok";
				# code...
			}else{
				echo "failure";
			}
			# code...
		}else{

		$info = $goods->find($goods_id);
		$this->assign('info',$info);
		$this->display();
	}
}
public function s1() {
	S('name','tom');
	echo "ok";
}
public function f1() {
	echo S('name');
}
}