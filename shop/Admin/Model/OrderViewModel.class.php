<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class OrderViewModel extends ViewModel {
	public $viewFields = array(
				'goods' => array('gid','main_title','price','goods_mini_img',
					'_type' =>'INNER',
					),
				'order' => array('goods_id','orderid','user_id','goods_num','total_money','status','_as'=>'torder',
					'_type' =>'INNER',
					'_on' => 'torder.goods_id = goods.gid'
					),
				

				
		);
}