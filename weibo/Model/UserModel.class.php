<?php
namespace Model;
use Think\Model;
class UserModel extends Model {
	protected $_validate  =  array(
		 array('username','require','用户名必填'),




		);
}