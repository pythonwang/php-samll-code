<?php
namespace Member\Model;
use Think\Model\ViewModel;
class CollectViewModel extends ViewModel {
		public $viewFields = array(
			'collect' => array('user_id','goods_id',
				'_type' =>'INNER',
				),
			'goods' => array('gid','main_title','price','end_time','goods_mini_img',
				'_type' =>'INNER',
				'_on' => 'collect.goods_id = goods.gid'
				),
			'user' => array('uid',
				'_type' =>'INNER',
				'_on' => 'collect.user_id = user.uid'
				),

			);

		

}