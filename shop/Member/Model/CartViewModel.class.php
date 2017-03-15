<?php
namespace Member\Model;
use Think\Model\ViewModel;
class CartViewModel extends ViewModel {
		public $viewFields = array(
			'goods' => array('gid','shopid','cid','lid','main_title','sub_title','price','old_price','begin_time','end_time','goods_max_img','goods_med_img','goods_small_img','goods_mini_img',
				'_type' =>'INNER'
				),
			'cart' => array('user_id','goods_id','goods_num','cart_id',
				'_type' =>'INNER',
				'_on' => 'goods.gid = cart.goods_id'
				)
			);
}