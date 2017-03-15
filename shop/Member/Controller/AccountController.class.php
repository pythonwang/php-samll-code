<?php
namespace Member\Controller;
use Member\Controller\CommonController;
class AccountController extends CommonController {
	public function index() {
		$balance = M('userinfo')->where(array('user_id' =>session('uid')))->getField('balance');
		$this->balance = $balance;
		$this->display();
	}

	/**
	 * 用户账户设置
	 */
	public function setting(){
		$user = M('user')->where(array('uid' =>session('uid')))->find();
		$this->user = $user;
		$this->display();
	}

	 /* 设置收货地址
	 */
	public function setAddress(){
		
		$address = M('user_address')->where(array('user_id' =>session('uid')))->select();
		$this->assign('address', $address);
		$this->display();
	}
	
	public function delAddress(){
		
		$id = $_GET['addressid'];
		$info = M('user_address')->where(array('addressid' => $id))->delete();
		if($info){
			$this->success('删除成功!',U('setAddress'));
		}else{
			$this->error('删除失败!');
		}
	}
	/**
	 * 添加收货地址
	 */
	public function addAddress(){
		$data = array();
		foreach ($_POST as $k=>$v){
			$data[$k] = strip_tags($v);
		}
		$data['user_id'] = session('uid');
		$info = M('user_address')->add($data);
		if($info){
			$this->success('添加成功',U('setting'));
		}else{
			$this->error('添加失败');
		}
	}
	/**
	 * 账户充值
	 */
	public function add(){
		$ref = $_SERVER['HTTP_REFERER'];
			echo '<script> alert("暂无，敬请期待！");location.href="'. $ref.'";</script>';
		/*$data = array();
		if($db->addBalance($this->uid)){
			$this->success('充值成功',U('index'));
		}else{
			$this->success('充值失败',U('index'));
		}*/
		$this->display();
	}
}