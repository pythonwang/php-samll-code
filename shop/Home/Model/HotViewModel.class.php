<?php
namespace Home\Model;
use Think\Model\ViewModel;
class HotViewModel extends ViewModel {
		public $viewFields = array(
			'goods' => array('cid'=>'gcid',
				'_type' =>'INNER'
				),
			'category' => array('cid','cname',
				'_type' =>'INNER',
				'_on' => 'goods.cid = category.cid'
				)
			);
}