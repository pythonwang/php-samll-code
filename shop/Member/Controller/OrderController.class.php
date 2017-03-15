<?php
namespace Member\Controller;
use Member\Controller\CommonController;
class OrderController extends CommonController {
	public function index() {
		$status = (int)$_GET['status'];
		$menu = array();
		if (empty($status)) {
			//菜单高亮显示
			$menu[] ='<a href="' .U('Member/Order/index') . '" class="active">全部</a>';
			$menu[] = '<a href="' . U('Member/Order/index') . '/status/1' . '">未付款</a>';
			$menu[] = '<a href="' . U('Member/Order/index') . '/status/2' . '">已付款</a>';
		}else{
			$menu[] ='<a href="' .U('Member/Order/index') . '">全部</a>';
			if ($status == 1) {
				$menu[] = '<a href="' . U('Member/Order/index') . '/status/1' . '" class="active">未付款</a>';
				$menu[] = '<a href="' . U('Member/Order/index') . '/status/2' . '">已付款</a>';
			}else{
				$menu[] = '<a href="' . U('Member/Order/index') . '/status/1' . '">未付款</a>';
				$menu[] = '<a href="' . U('Member/Order/index') . '/status/2' . '" class="active">已付款</a>';
			}
		}
		$this->menu = $menu;
		if (empty($status)) {
			$where = array('torder.user_id' =>session('uid'));
		}else{
			$where = array('torder.user_id' =>session('uid'),'torder.status' =>$status);
		}
		$order = D('OrderView')->where($where)->select();
		
		foreach ($order as $k => $v) {
			$order[$k]['zongji'] = $v['goods_num']*$v['price'];
		}
		$this->order = $order;
		$this->display();
	}
	//我的团购删除订单
	public function del() {
		$oid = $_GET['oid'];
		if (empty($oid)) {
			E('页面错误');
		}
		$z = M('order')->where(array('user_id' => session('uid'),'orderid' =>$oid))->delete();
		if ($z) {
			$this->success('删除成功',U('index'));
		}else{
			$this->error('删除失败！');
		}
	}
}