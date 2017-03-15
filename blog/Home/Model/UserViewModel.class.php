<?php
namespace Home\Model;
use Think\Model\ViewModel;
class UserViewModel extends ViewModel {
	public $viewFields = array(
		'blog' =>array(
			'id','title','time','click','summary','content',
			'_type' =>'LEFT'
			),
		'user' =>array(
			'username', '_on' => 'blog.uid = user.id'

			),
		);
}