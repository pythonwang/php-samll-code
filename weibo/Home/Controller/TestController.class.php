<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
	public function zhuce() {
		$user = new \Model\TestModel();
		if (!empty($_POST)) {
			dump($_POST);
    		 $user->create();

    		 if (!$user->create()) {
    		 	echo 'Error';
    		 	exit();
    		 	# code...
    		 }
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
    		
	}
}