<?php
namespace Home\Model;
use Think\Model;
use Think\Model\ViewModel;
class CommentViewModel extends ViewModel {
	public $viewFields = array(
		'comment' => array(
			'id','content','time',
			'_type' => 'LEFT'
			),
		'userinfo' => array(
			'username','face50' => 'face','uid',
			'_on' => 'comment.uid = userinfo.uid'
			)

		);
}