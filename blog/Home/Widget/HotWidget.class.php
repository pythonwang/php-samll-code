<?php
namespace Home\Widget;
use Think\Controller;
class HotWidget extends Controller {
	//最热博文
    public function menu(){
    	$field = array('id', 'title', 'click');
        $menu = M('blog')->field($field)->where(array('del' => 0))->order('click DESC')->limit(5)->select();
        $this->assign('menu',$menu);
        $this->display('Hot:menu');
    }
    //最新发布博文
    public function newest() {
    	$field = array('id', 'title', 'time','click');
        $new = M('blog')->field($field)->where(array('del' => 0))->order('time DESC')->limit(5)->select();
        $this->assign('new',$new);
        $this->display('Hot:newest');
    }
}
