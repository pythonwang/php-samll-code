<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel {

	protected $_link = array(




		'Content'=>array(

			'mapping_type'=>self::HAS_MANY,
			'foreign_key'=>'uid',
			),
		);
}