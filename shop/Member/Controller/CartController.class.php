<?php
namespace Member\Controller;
use Member\Controller\CommonController;
class CartController extends CommonController {
	public function index() {
		$cart = $this->getcartdata();
		$data = $this->discart($cart);
		//分配收货地址
		$address = M('user_address')->where(array('user_id'=>session('uid')))->select();
		$this->assign('address', $address);
		//购物车下拉菜单
		if (!IS_AJAX) {
			$this->cart = $data[0];
			$this->total = $data[1];
			$this->display();
		}else{
			if (isset($data[0])) {
				echo json_encode(array('status' =>true, 'data' => $data[0]));
			}else{
				echo json_encode(array('status' =>false, 'data' => $data[0]));
			}
		
		}


	}

	//异步添加购物车
	public function add() {
		if (!IS_AJAX) {
			E('页面错误');
		}
		//调用购物车处理函数
		$cart = new \Component\Cart();
		//用户未注册，未登录添加购物车
		if (empty($_SESSION['uid'])) {
			//$_SESSION['cart'] = $_GET['gid'];
			$data = array(
				'id' => $_GET['gid'],
				'name' => '',
				'num' => 1,
				'price' =>0

				);
			$cart::add($data);
			$total = count($_SESSION['cart']['goods']);//购物车商品总数
			$result = array('status' => true,'total' =>$total);
		}else{
			$db = M('cart');
			
			//第一次登陆，把session的数据写入数据库
			//function在login界面
					//用户登录状态,无session购物车时,直接添加数据库
				//第一条新数据
					$data = array(
					'goods_id' => $_GET['gid'],
					'user_id' => session('uid'),
					'goods_num' => 1

					);
					$where = array('user_id' => $data['user_id'],'goods_id' => $data['goods_id']);
					$cart_id = $db->where($where)->getField('cart_id');
					
					//有相同商品+1，否则添加新商品
						if ($cart_id) {
							$db->where(array('cart_id' => $cart_id))->setInc('goods_num');
						}else{
							$db->add($data);
							
						}
			//购物车总数，返回给js显示
			$total = $db->where(array('user_id' => session('uid')))->count();
			if ($total) {
				$result = array('status' => true,'total' =>$total);
			}
		}
		echo json_encode($result);
	}
	
	public function getcartdata() {
		$db = M('cart');
		$result = array();
		if (empty(session('uid'))) {
			if (isset($_SESSION['cart']['goods'])) {
				$carts = $_SESSION['cart']['goods'];
				foreach ($carts as $v) {
					$fields = array('main_title', 'gid', 'price', 'end_time','goods_mini_img'
						);
					$data = M('goods')->field($fields)->where(array('gid' => $v['id']))->find();
					$data['goods_num'] = $v['num'];
					$result[] = $data;
				}
			}
		}else{
			$result = $this->getcartall();

		}
		return $result;
	}
	//处理商品数据
	public function discart($cart) {
		if (empty($cart)) return false;
		$total = 0;
		foreach ($cart as $k => $v) {
			$cart[$k]['subtotal'] = $v['goods_num'] * $v['price'];
			$cart[$k]['status'] = $v['end_time'] < time() ? '已下架' : '可购买';
			$total += $cart[$k]['subtotal'];
		}
			return array($cart,$total);
	}
	//购物车商品数加减
	public function updateGoodsNum() {
		if (!IS_AJAX) return false;
		$gid = $_POST['gid'];
		$num = $_POST['num'];
		//没有登录
		if (empty(session('uid'))) {
			foreach ($_SESSION['cart']['goods'] as $k => $v) {
				if ($v['id'] == $gid) {
					$_SESSION['cart']['goods'][$k]['num'] = $num;
					$result = array(
						'status' =>true,
						'num' =>$num
						);
				}
			}
		}else{
			$db = M('cart');
			$where = array(
				'goods_id' => $gid,
				'user_id' => session('uid')
				);
			$z = $db->where($where)->save(array('goods_num' =>$num));
			if ($z) {
				$result = array(
						'status' =>true,
						'num' =>$num
						);
			}
		}
		echo json_encode($result);
	}
	public function getcartall() {
		$fields = array(
			'main_title',
			'gid',
			'goods_mini_img',
			'price',
			'end_time',
			'cart_id',
			'goods_num'	
		);
		$res = D('CartView')->field($fields)->where(array('user_id'=>session('uid')))->select();
		return $res;
	}
	//删除导航栏购物车
	public function del() {
		if (!IS_AJAX) exit;
		$gid = $_GET['gid'];
		$result = array();
		$result['status'] = false;
		if (empty(session('uid'))) {
			//未登录
			foreach ($_SESSION['cart']['goods'] as $k => $v) {
				if ($v['id'] == $gid) {
					unset($_SESSION['cart']['goods'][$k]);
					$result['status'] = true;
				}
			}
		}else{//用户已登录
			$where = array('user_id' =>session('uid'),'goods_id' => $gid);
			$z = M('cart')->where($where)->delete();
			if ($z) {
				$result['status'] = true;
			}
		}
		echo json_encode($result);
	}
	//删除我的购物车商品
	public function delgoods() {
		$gid = $_GET['gid'];
		if (empty(session('uid'))) {
			//未登录
			foreach ($_SESSION['cart']['goods'] as $k => $v) {
				if ($v['id'] == $gid) {
					unset($_SESSION['cart']['goods'][$k]);
					$this->success('删除成功',U('index'));
				}else{
					$this->error('删除失败');
				}
			}
		}else{//用户已登录
			$where = array('user_id' =>session('uid'),'goods_id' => $gid);
			$z = M('cart')->where($where)->delete();
			if ($z) {
				$this->success('删除成功',U('index'));
			}else{
				$this->error('删除失败');
			}
		}

	}
}