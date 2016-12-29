<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class CommentViewModel extends ViewModel {
	public $viewFields = array(
		'comment' => array(
			'id', 'content', 'time', 'wid',
			'_type' => 'LEFT'
			),
		'userinfo' => array(
			'username', '_on' => 'comment.uid = userinfo.uid'
			)

		);

}