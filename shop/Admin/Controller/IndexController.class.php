<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Admin\Controller\CommonController;
class IndexController extends CommonController {
    public function index(){
	$this->display();
    }
    public function welcome() {
    	$info = array(
            'system'=>PHP_OS,
            'soft'=>$_SERVER["SERVER_SOFTWARE"],
            'name'=>$_SERVER['SERVER_NAME'],
            'tcp'=>$_SERVER['SERVER_PORT'],
            'tpversion'=>THINK_VERSION,
            'time'=>date("Y年n月j日 H:i:s"),
            'ip'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
        );
        $this->info=$info;
    	$this->display();
    }
}