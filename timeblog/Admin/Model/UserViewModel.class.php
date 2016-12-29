<?php
namespace Admin\Model;
use Think\Model\viewModel;
class UserViewModel extends viewModel {
	public $viewFields = array(
		'user' => array(
			'id', '`lock`', 'registime',
			'_type' => 'LEFT'

			),
		'userinfo' => array(
			'username', 'face50' => 'face', 'follow', 'fans', 'weibo',
			'_on' => 'user.id = userinfo.uid'

			)
		);
}