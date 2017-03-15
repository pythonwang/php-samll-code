<?php
namespace Home\Model;
use Think\Model\ViewModel;
class GoodsViewModel extends ViewModel {
		public $viewFields = array(
			'goods' => array('gid','shopid','cid'=>'gcid','lid'=>'glid','main_title','sub_title','price','old_price','begin_time','end_time','goods_max_img','goods_med_img','goods_small_img','goods_mini_img','buy',
				'_type' =>'INNER'
				),
			'category' => array('cid','cname','keywords','title',
				'_type' =>'INNER',
				'_on' => 'goods.cid = category.cid'
				),
			'locality' => array('lid','lname','pid',
				'_type' =>'INNER',
				'_on' =>'goods.lid = locality.lid'
				),
			'shop' => array('shopid','shopname','shopaddress','metroaddress','shoptel','shopcoord',
				'_type' =>'INNER',
				'_on' =>'goods.shopid = shop.shopid'
				),
			'goods_detail' => array('detail','goods_server',
				'_type' =>'INNER',
				'_on' =>'goods.gid = goods_detail.goods_id'
				),



			);

		

}