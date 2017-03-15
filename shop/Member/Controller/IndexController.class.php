<?php
namespace Member\Controller;
use Member\Controller\CommonController;
class IndexController extends CommonController {
    public function collect(){
        $status = $_GET['status'];
        $time = date('Y-m-d H:i',time());
        if (empty($status)) {
           $where = array('user_id' =>session('uid'));
        }else{
            if ($status ==1) {
                $where = array('user_id' =>session('uid'),'end_time'=>array('GT',$time));
            }else{
                $where = array('user_id' =>session('uid'),'end_time'=>array('LT',$time));
            }
        }
        $data = D('CollectView')->where($where)->select();
        
       foreach ($data as $k => $v) {
            $data[$k]['status'] = $v['end_time'] > $time ? '进行中' : '已结束';
        }
        $this->collect = $data;
	   $this->display();
    }

    //添加收藏
    public function addcollect() {
        $gid = $_GET['gid'];
        $data = array(
            'user_id' => session('uid'),
            'goods_id' => $gid
            );
        $z = M('collect')->where($data)->count();
        $result = array();
        if ($z) {
            $result = array('status' => true);
        }else{
                if(M('collect')->add($data)) {
                     $result = array('status' => true);
                }else{
                     $result = array('status' => false);
                }
        }
        echo json_encode($result);
    }
    //删除收藏
    public function delCollect() {
        $where = array('user_id' => session('uid'), 'goods_id' => $_GET['gid']);
        $z = M('collect')->where($where)->delete();
        if ($z) {
           $this->success('删除成功',U('collect'));
        }else{
            $this->error('删除失败');
        }
    }

    //获得最近浏览
    public function getRecentView() {
    	if (!IS_AJAX) return false;
    	$Encry = new \Component\Encry();
		$key = $Encry::encrypt('recent-view');
        $result = array();
        if(!isset($_COOKIE[$key])){
        		$result['status'] = false;
        		echo json_encode($result);
        	}
        $value = unserialize($Encry::decrypt($_COOKIE[$key]));
  
        $fields = array(
			'main_title',
			'gid',
			'goods_mini_img',
			'price',
			'end_time',
			'old_price'	
		);
		$data = M('goods')->field($fields)->where(array('gid' => array('IN',$value)))->select();
    		if ($data) {
    			$result['status'] = true;
    			$result['data'] = $data;
    			
    		}else{
    			$result['status'] = false;
    		}
    		echo json_encode($result);
    	
    }
    //清空最近浏览
    public function clearRecentView() {
    	if(!IS_AJAX) exit;
    	$Encry = new \Component\Encry();
		$key = $Encry::encrypt('recent-view');
		if (isset($_COOKIE[$key])) {
			unset($_COOKIE[$key]);
		}
		setcookie($key,'',1,'/');
    }

    //城市选择
    public function selcity() {
        
        $selid = M('locality')->field('lid,lname')->where(array('pid' => 0 ))->select();

        $citylid = $_GET['lid'];
        if (!empty($citylid)) {
            $citypid = M('locality')->where(array('lid' => $citylid))->getField('pid');
            if ($citypid == 0) {
                if ($_SESSION['citylid'] != $citylid) {
                    $cityname = M('locality')->where(array('lid' => $citylid))->getField('lname');
                    unset($_SESSION['citylid']);
                    unset($_SESSION['cityname']);
                    session('citylid',$citylid);
                    session('cityname',$cityname);
                }
            }
        }
        $this->selid = $selid;
    }

    
}