<?php
namespace Admin\Controller;
use Think\Controller;
class ShopController extends Controller {
	//商铺展示列表
	public function index() {
			$total = M('shop')->count();
			$per = 7;
			$page = new \Component\Page($total,$per);
			$str = $page->limit;
			$limit = substr($str,5);//把limit字符去掉
			$shop = M('shop')->order('shopid')->limit($limit)->select();
			$pagelist =$page->fpage();
			
			$this->shop = $shop;
			$this->assign('page',$pagelist);
			$this->display();
	}
	//添加商铺
	public function add() {

			$this->display();
	}
	//添加商铺表单处理
	public function runadd() {
		if (IS_POST) {
		$data = array(
			'shopname' => $_POST['shopname'],
			'shopaddress' => $_POST['shopaddress'],
			'metroaddress' => $_POST['metroaddress'],
			'shoptel' => $_POST['shoptel'],
			'shopcoord' => $_POST['shopcoord']
			);
		$z = M('shop')->add($data);
		if ($z) {
			$this->success('添加商铺成功',U('index'));
			
		}else{
			$this->error('添加商铺失败');
		}
	}
	}
	//编辑商铺
	public function edit() {
			$shopid = $_GET['shopid'];
			$edshop = M('shop')->where(array('shopid' => $shopid))->find();
			$this->edshop = $edshop;
			$this->display();
	}

	public function runedit() {
		if (IS_POST) {
			$shopid = $_GET['shopid'];
		$data = array(
			'shopname' => $_POST['shopname'],
			'shopaddress' => $_POST['shopaddress'],
			'metroaddress' => $_POST['metroaddress'],
			'shoptel' => $_POST['shoptel'],
			'shopcoord' => $_POST['shopcoord']
			);
		$z = M('shop')->where(array('shopid' => $shopid))->save($data);
		if ($z) {
			$this->success('修改商铺成功',U('index'));
			
		}else{
			$this->error('修改商铺失败');
		}
	}
	}
	//百度地图API获取地址
	public function baidu() {

			$this->display();
	}

	//删除商铺
	public function del() {
		$shopid = $_GET['shopid'];
		$z = M('shop')->where(array('shopid' => $shopid))->delete();
		if ($z) {
			$this->success('删除商铺成功',U('index'));
			
		}else{
			$this->error('删除商铺失败');
		}
	}
}