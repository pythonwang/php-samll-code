<?php
namespace Home\Model;
use Think\Model\RelationModel;
class BlogRelationModel extends RelationModel {
	protected $tableName = 'blog';
	protected $_link = array(
		'attr' => array(
			'mapping_type' =>self:: MANY_TO_MANY,
			'foreign_key' => 'bid',
			'relation_foreign_key' => 'aid',
			'relation_table' => 'tm_blogattr'
			),
		'cate' => array(
			'mapping_type' =>self::BELONGS_TO,
			'foreign_key' => 'cid',
			'mapping_fields' =>'name',
			'as_fields' => 'name:cate'
			)
		);
}