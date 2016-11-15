<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller {
    public function index(){
    	
	
    }

    public function number() {


    }
    public function register() {
    	$user = new \Model\UserModel();
    	if (!empty($_POST)) {
    		dump($_POST);
    		 $user->create();

    		 if (!$user->create()) {
    		 	echo 'getError';
    		 	exit();
    		 	# code...
    		 }
    		 $user -> user_hobby = implode(',',$_POST['user_hobby']);
    		$rst =$user->add();
    		if ($rst) {
    			echo "ok";
    			# code...
    		}else{
    			echo "failuer";
    		}
    	}else{	
    	}
    	$this->display();
    		
    		# code...
    	
    }
    }
