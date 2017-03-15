<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class UserViewModel extends ViewModel {
	public $viewFields = array(
				'user' => array('uid','email','uname','registime','phone',
					'_type' =>'INNER',
					),
				'userinfo' => array('user_id','balance','integral',
					'_type' =>'INNER',
					'_on' => 'user.uid = userinfo.user_id'
					),
				

				
		);
}