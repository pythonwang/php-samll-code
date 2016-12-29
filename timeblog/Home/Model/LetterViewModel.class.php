<?php
namespace Home\Model;
use Think\Model;
use Think\Model\ViewModel;
class LetterViewModel extends ViewModel {
	public $viewFields = array(
		'letter' => array(
			'id', 'content', 'time',
			'_type' => 'LEFT'
			),
		'userinfo' => array(
			'username', 'face50' => 'face', 'uid',
			'_on' => 'letter.from = userinfo.uid'
			)

		);
}