<?php
namespace Home\Model;
use Think\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel{
	
	protected $_link = array(
		'userinfo' =>array(
			'mapping_type'=>self::HAS_ONE,
			'foreign_key' =>'uid',


			),

		);

}