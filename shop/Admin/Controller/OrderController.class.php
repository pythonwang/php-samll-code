<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
class OrderController extends CommonController {
		public function index() {
			$fields = array(
				'main_title',
				'goods_mini_img',
				'price',
				'goods_num',
				'orderid',
				'total_money',
				'status'
				);
			$where = array();
			$status =  (int)$_GET['status'];
			if(!empty($status)){
			$where['torder.status'] = $status;
			}
			//分页
			$per = 7;
			$total = D('OrderView')->where($where)->count();
			$page = new \Component\Page($total,$per);
			$str = $page->limit;
			$limit = substr($str,5);//把limit字符去掉
			$order = D('OrderView')->field($fields)->where($where)->order('torder.orderid DESC')->limit($limit)->select();
			$pagelist =$page->fpage();
			$this->order = $order;
			$this->assign('page',$pagelist);
			$this->display();
		}
		//删除订单
		public function delorder() {
			$orderid = (int)$_GET['oid'];
			$info = M('order')->where(array('orderid' =>$orderid))->delete();
			if ($info) {
				$this->success('删除成功',U('index'));
			}else{
				$this->error('删除失败');
			}
		}
}