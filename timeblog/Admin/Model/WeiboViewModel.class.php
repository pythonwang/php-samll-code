<?php
namespace Admin\Model;
use Think\Model\viewModel;
class WeiboViewModel extends viewModel {
	public $viewFields = array(
		'weibo' => array(
			'id', 'content', 'isturn', 'time', 'turn', 'keep', 'comment',
			'_type' =>'LEFT'
			),
		'picture' => array(
			'max' => 'pic', '_on' => 'weibo.id = picture.wid',
			'_type' => 'LEFT'
			),
		'userinfo' => array(
			'uid', 'username', '_on' => 'weibo.uid = userinfo.uid'
			)
		);
}