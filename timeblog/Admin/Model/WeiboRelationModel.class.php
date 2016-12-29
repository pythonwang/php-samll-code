<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class WeiboRelationModel extends RelationModel {
	protected $tableName = 'weibo';
	protected $_link = array(
		'picture' =>array(
			'mapping_type'=>self::HAS_ONE,
			'foreign_key' =>'wid'


			),
		'comment' =>array(
			'mapping_type'=>self::HAS_MANY,
			'foreign_key' =>'wid'
			),
		'keep' =>array(
			'mapping_type'=>self::HAS_MANY,
			'foreign_key' =>'wid'
			),
		'atme' =>array(
			'mapping_type'=>self::HAS_MANY,
			'foreign_key' =>'wid'
			)
		);

}