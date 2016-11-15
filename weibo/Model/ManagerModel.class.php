<?php
namespace Model;
use Think\model;
class ManagerModel extends Model {
	public function checkNamePwd($name,$pwd) {

		$info = $this->getByMg_name($name);
		if ($info !=null) {

			if ($info['mg_pwd'] !=$pwd) {
				return false;
				# code...
			}else{
				return $info;
			}
			# code...
		}else{
			return false;
		}

	}
}