<?php
namespace Model;
use Think\Model;

class RoleModel extends Model {
	public function saveAuth($auth,$role_id) {
		$auth_ids = implode(',',$auth);
		
		$info = D('Auth')->select($auth_ids);
		$auth_ac = '';
		foreach ($info as $k => $v) {
			if (!empty($v['auth_c']) && !empty($v['auth_a'])) {
				# code...
			
			$auth_ac .=$v['auth_c']."-".$v['auth_a'].",";
		}

			# code...
		}
		$auth_ac = rtrim($auth_ac,',');
		$dt = array(
			'role_id'=>$role_id,
			'role_auth_ids'=>$auth_ids,
			'role_auth_ac'=>$auth_ac,

			);
		return $this ->save($dt);

	}
}