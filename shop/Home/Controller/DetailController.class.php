<?php
namespace Home\Controller;
use Home\Controller\CommonController;
class DetailController extends CommonController {
	public function index() {

		$gid = $_GET['gid'];
		//得到商品细节
		$detail = D('GoodsView')->where(array('gid' =>$gid))->find();
		//折扣计算
		$detail['discount'] = round(($detail['price']/$detail['old_price']*10),1);
		if ($detail['end_time'] - time() > (60*60*24*3)) {
				$detail['end_time'] = '剩余<sapn>3</span>天以上';
		}else{
				$detail['end_time'] = date('Y-m-d H:i') . '下架';
		}
		//商品服务
		$goodsserver = array_slice(unserialize($detail['goods_server']),0,2);
		$server = C('goods_server');
		$detail['server'] = array(
				$server[$goodsserver[0]],
				$server[$goodsserver[1]]
			);
		$this->relationgoods($detail['cid']);
		$this->detail = $detail;
		$this->display();
	}
	//还看了哪些团购
	public function relationgoods($cid) {
		$fields = array(
			'gid',
			'main_title',
			'goods_small_img',
			'price',
			'old_price',
			'buy'
			);
		$related = M('goods')->field($fields)->where(array('cid' =>$cid))->limit(5)->select();
		$this->related = $related;
	}
}