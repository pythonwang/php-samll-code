<?php
namespace Member\Controller;
use Member\Controller\CommonController;
class BuyController extends CommonController {
	public function index() {
		//分配收货地址
		$address = M('user_address')->where(array('user_id'=>session('uid')))->select();
		$this->assign('address', $address);
		/** 处理订单  ***/
		$gid = $_GET['gid'];
		$fields = array(
			'main_title',
			'gid',
			'price',
			'goods_mini_img'
			);
		$goods = M('goods')->field($fields)->where(array('gid' =>$gid))->find();
		$this->assign('goods',$goods);
		$this->display();
	}
	/**
	 * 付款页 
	 */
	public function payment() {
		if (IS_POST) {
			if (is_array($_POST['gid'])) {
				$data = $_POST;
				foreach ($data['gid'] as $k => $v) {
					$_POST = array(
						'gid' => $v,
						'price' => $data['price'][$k],
						'goods_num' => $data['goods_num'][$k],
						'addressid' => $data['addressid'][$k]
						);

					if(!$this->addorder()) {
					$this->error('订单提交失败');
					}
				}
			}else{
				if(!$this->addorder()) {
					$this->error('订单提交失败');
				}
			}
		}
		$order = $this->getorder();
		$sum = array();
		foreach ($order as $v) {
			$sum[] = $v['price']*$v['goods_num'];
		}
		$balance = $this->getbalance();
		$this->balance = $balance;
		$this->sumprice = array_sum($sum);
		$this->order = $order;
		$this->display();
	}
	/**
	 * 添加订单
	 */
	private function addorder() {
		if (empty($_POST['addressid'])) {
			$ref = $_SERVER['HTTP_REFERER'];
			echo '<script> alert("请填写收货地址");location.href="'. $ref.'";</script>';
		}
		$data =array(
			'user_id' => session('uid'),
			'goods_id' => $_POST['gid'],
			'goods_num' => $_POST['goods_num'],
			'addressid' => $_POST['addressid'],
			'total_money' => $_POST['price']*$_POST['goods_num']
			);
		$orderid = M('order')->where(array('user_id' => session('uid'),'goods_id' =>$_POST['gid'],'status' =>1))->getField('orderid');
		if ($orderid) {
			$num = M('order')->where(array('user_id' => session('uid'),'goods_id' =>$_POST['gid'],'status' =>1))->getField('goods_num');
			$da =array(
			'goods_num' => $_POST['goods_num'] + $num,
			'addressid' => $_POST['addressid'],
			'total_money' => $_POST['price']*($_POST['goods_num'] + $num)
			);
			$addorder = M('order')->where(array('orderid' =>$orderid))->save($da);
		}else{
			$addorder = M('order')->add($data);
			
		}
		return $addorder;
	}
	//获得提交的订单数据，在支付页面显示
	private function getorder() {
		$orderid = $_GET['oid'];
		if(empty($orderid)){
			$where = array(array('torder.user_id' =>session('uid'),'torder.status' =>1));
		}else{
			$where = array('torder.orderid'=>$orderid);
		}
		$order = D('OrderView')->where($where)->select();
		return $order;
	}
	//余额查询
	public function getbalance() {
		return M('userinfo')->where(array('user_id' =>session('uid')))->getField('balance');
	}

	public function buysuccess($orderids,$totalprice) {
		//成功修改订单状态status
		$z = M('order')->where(array('orderid' =>array('IN',$orderids)))->save(array('status' =>2));
		if (!$z) {
			$this->error('付款失败');
		}else{
			//更新余额
			M('userinfo')->where(array('user_id' => session('uid')))->setDec('balance',$totalprice);
		}
		$this->display('buysuccess');
	}
	//验证提交的确认支付的购物信息
	public function checkbuy() {
		if (!IS_POST) {
			exit;
		}
		$orderids = $_POST['orderid'];
		
		$data = D('OrderView')->field('price,goods_num')->where(array('torder.orderid' =>array('IN',$orderids)))->select();
		$sum = array();
		foreach ($data as $v) {
			$sum[] = $v['price']*$v['goods_num'];
		}
		$totalprice = array_sum($sum);
		$this->totalprice = $totalprice;
		$balance = M('userinfo')->where(array('user_id' =>session('uid')))->getField('balance');
		if ($balance < $totalprice) {
			$this->error('余额不足，付款失败,请充值',U('Member/Account/index'));
		}else{
			$this->buysuccess($orderids,$totalprice);
		}
	}
}