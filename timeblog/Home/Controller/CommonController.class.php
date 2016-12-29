<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function _initialize() {
		if (isset($_COOKIE['auto']) && !isset($_SESSION['uid'])) {
			$value = explode('|',encryption($_COOKIE['auto'],1));
			
			$ip = get_client_ip();
//本次登录IP和上次登录IP一致
			if ($ip==$value[1]) {
				$account = $value[0];
				$user=D('User')->getByAccount($account);
				if ($user && !$user['lock']) {
					session('uid',$user['id']);
					# code...
				}
							# code...
						}			
			
		}
		if (!isset($_SESSION['uid'])) {
    		redirect(U('Login/index'));
    		
    	}
    	

    	}
	//头像上传
	public function uploadFace() {
		if (!IS_POST) {
			E('页面不存在');
			# code...
		}
		$config = array(
					'rootPath'   =>  './Uploads/',
					'savePath'   =>'upload/',
					
					


					);
				$upload = new \Think\Upload($config);
				$info= $upload -> upload();
				
				if (!$info) {
					dump($upload->getError());
					
					# code...
				}else{
					foreach ($info as $z) {

						# code...
					
					$bigimg = $z['savepath'].$z['savename'];

					
					

					$image = new \Think\Image();
					$srcimg = $upload->rootPath.$bigimg;
					$image->open($srcimg);
					//NO.1
                	$image->thumb(180,180);  // 设置宽高
                // 保存缩略图片
					$smallimg=$z['savepath']."max_".$z['savename'];

					$image->save($upload->rootPath.$smallimg);
					//$max =$smalling;
					

					//NO.2
					$image->thumb(80,80);
					$smallimg=$z['savepath']."med_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);
					
					

					//NO.3
					$image->thumb(50,50);
					$smallimg=$z['savepath']."mini_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);
					
					//$_POST['small'.$k] = $smallimg[$k];
					

					 $aa = $z['savepath']."max_".$z['savename'];
					 $bb = $z['savepath']."med_".$z['savename'];
					 $cc = $z['savepath']."mini_".$z['savename'];
				
					
					
				}
				//传值给js，赋值到input图片路径，图片预览
				$pa=array(
					'path'=>array(
					'max'=>$aa,
					'med'=>$bb,
					'mini'=>$cc
					)
					);
				echo json_encode($pa);

			    
			     

	}		

}
//文章图片上传
public function uploadPic() {
	if (!IS_POST) {
		E('页面不存在');
		# code...
	}
	$config = array(
					'rootPath'   =>  './Uploads/',
					'savePath'   =>'pic/',
					);
				$upload = new \Think\Upload($config);
				$info= $upload -> upload();
				if (!$info) {
					//dump($upload->getError());
					# code...
				}else{
					foreach ($info as $z) {
					
					$bigimg = $z['savepath'].$z['savename'];

					$image = new \Think\Image();
					$srcimg = $upload->rootPath.$bigimg;
					$image->open($srcimg);
					//NO.1
                	$image->thumb(800,800);  // 设置宽高
                // 保存缩略图片
					$smallimg=$z['savepath']."max_".$z['savename'];

					$image->save($upload->rootPath.$smallimg);
					//$max =$smalling;
					

					//NO.2
					$image->thumb(380,380);
					$smallimg=$z['savepath']."med_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);
					
					

					//NO.3
					$image->thumb(120,120);
					$smallimg=$z['savepath']."mini_".$z['savename'];
					$image->save($upload->rootPath.$smallimg);
					
					//$_POST['small'.$k] = $smallimg[$k];
					$aa = $z['savepath']."max_".$z['savename'];
					$bb = $z['savepath']."med_".$z['savename'];
					$cc = $z['savepath']."mini_".$z['savename'];
					
				}
				//传值给js，赋值到input图片路径，图片预览
				$pa=array(
					'path'=>array(
					'max'=>$aa,
					'med'=>$bb,
					'mini'=>$cc
					)
					);
				echo json_encode($pa);


					
						
					
				}
			}


	//异步移除关注和粉丝
	public function delFollow() {
		if (!IS_AJAX) {
			E('页面不存在');
			# code...
		}
		$uid = $_POST['uid'];
		$type = $_POST['type'];
		$where = $type ? array('follow' => $uid, 'fans' => session('uid')) : array('fans' => $uid, 'follow' => session('uid'));
		if (M('follow')->where($where)->delete()) {
			$db = M('userinfo');
			if ($type) {
				$db -> where(array('uid' => session('uid')))->setDec('follow');
				$db -> where(array('uid' => $uid))->setDec('fans'); 
				# code...
			}else{
				$db -> where(array('uid' => session('uid')))->setDec('fans');
				$db -> where(array('uid' => $uid))->setDec('follow');
			}
			echo 1;

			# code...
		}else{
			echo 0;
		}
	}	



	//修改模板风格

	public function editStyle() {
		if(!IS_AJAX) {
			E('页面不存在');
		}
		$style = $_POST['style'];
		$where = array('uid' => session('uid'));
		$z = M('userinfo')->where($where)->save(array('style' => $style));
		if ($z) {
			echo 1;
			# code...
		}else{
			echo 0;
		}
	}	
		
	//创建新分组			

public function addGroup() {
	if (!IS_AJAX) {
		E('页面不存在');
		# code...
	}
	$data = array(
		'name' => $_POST['name'],
		'uid' => session('uid'),
		);
	$z = D('group')->add($data);
	if ($z) {
		echo json_encode(array('status' =>1, 'msg' =>'创建成功'));
		# code...
	}else{
		echo json_encode(array('status' =>0, 'msg' =>'创建失败，请重试...'));

	}
}
public function addFollow() {
	if (!IS_AJAX) {
		E('页面不存在');
		# code...
	}
	$data = array(
		'follow' =>$_POST['follow'],
		'fans' =>(int) session('uid'),
		'gid' => $_POST['gid']
		);
	$z = M('follow')->add($data);
	if ($z) {
	$db = M('userinfo');
	$db->where(array('uid' =>$data['follow']))->setInc('fans');
	$db->where(array('uid' =>session('uid')))->setInc('follow');
	echo json_encode(array('status' =>1, 'msg' =>'关注成功'));


		# code...
	}else{
		echo json_encode(array('status' =>0, 'msg' =>'关注失败'));
	}

}
}