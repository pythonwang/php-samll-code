<?php
namespace Model;
use Think\Model;
class AuthModel extends Model {

	public function addAuth($auth) {



		$new_id = $this->add($auth);
		if ($auth['auth_pid'] == 0) {
			$auth_path = $new_id;
			# code...
		}else{//level!=0;

			$pinfo = $this->find($auth['auth_pid']);
			$p_path = $pinfo['auth_path'];
			$auth_path = $p_path."-".$new_id;

		}
		$auth_level = count(explode('-',$auth_path))-1;

		$dt = array(
			'auth_id' => $new_id,
			'auth_path' => $auth_path,
			'auth_level' => $auth_level,


			);
		return $this->save($dt);
	}
}