<?php
namespace Home\Controller;
use Home\Controller\CommonController;
class SearchController extends CommonController {
	public function sechUser() {
		$keyword = $this->_getKeyword();
		if ($keyword) {
			//用户不包括自己
			$where = array(
				'username' => array('LIKE','%' . $keyword . '%'),
				'uid' => array('NEQ',session('uid')),
				);
			$field = array('username','sex','location','intro','face80','follow','fans','weibo','uid');
			$db = D('userinfo');
			$result = $db->where($where)->field($field)->select();
			//dump($result);
			
			//分页
		
		$total = $db->where($where)->field($field)->count();


		$per = 7;
		//引用的不是Think下的自带分页page,所以thinkphp数据分页语法不能使用连贯查询，用原生sql
		$page = new \Component\Page($total,$per);
		
		//$limit = $page->firstRow; //.','. $page->listRows;
		
		//$info= $db->where($where)->field($field)->limit($limit)->select();
		$sion=$_SESSION['uid'];

		$sql = "SELECT * FROM hd_userinfo WHERE username LIKE '%$keyword%' and uid <>'$sion' ".$page->limit;
		//sql里面插入变量双引号或者{}，session先赋值给其他变量引入
		$info = $db->query($sql);
		$info = $this->_getMutual($info);
		
		$pagelist =$page->fpage();

		
		
		$this->count = $total;
		$this->info = $info ? $info : false;
		$this->assign('pagelist',$pagelist);

		}
		$this->keyword = $keyword;
		$this->display();

	}
	//搜索微博
	public function sechWeibo() {
		$keyword = $this->_getKeyword();
		if ($keyword) {
			//用户不包括自己
			$where = array('content' => array('LIKE','%' . $keyword . '%')
				);
			
		$db = D('WeiboView');
			
		$total = M('weibo')->where($where)->count();
		$per = 7;
		$page = new \Component\Page($total,$per);
		$str = $page->limit;
		$limit = substr($str,5);//把limit字符去掉
		
		
		
		$weibo = $db->getAll($where,$limit);
		
		
		$pagelist =$page->fpage();

		
		
		$this->count = $total;
		$this->weibo = $weibo ? $weibo : false;
		$this->assign('page',$pagelist);

		}
		$this->keyword = $keyword;

		$this->display();
	}
	private function _getKeyword() {
		return $_GET['keyword'] == '搜索微博、找人' ? NULL : $_GET['keyword'];
	}
	//重组结果集得到是否关注
	//$info需要处理的结果集
	private function _getMutual($info) {
		if (!$info) return false;
		$db = M('follow');
		
		  
		     foreach ($info as $k =>$v) {
		   
//foreach循环已经查询出info里面的结果
			
			$sion=$_SESSION['uid'];
			//$f=$v['uid'];
			//dump($v['uid']);
			
			$sql = "SELECT follow from hd_follow where follow='{$v['uid']}' and fans='$sion' union select follow from hd_follow where follow='$sion' and fans='{$v['uid']}'";

			$mutual = $db->query($sql);
			//$dd=$db ->getLastSql();
			//判断是否关注
			if (count($mutual) == 2) {
				$info[$k]['mutual'] = 1;
				$info[$k]['followed'] = 1;
				# code...
			}else{
				$info[$k]['mutual'] = 0;
				$where = array(
					'follow' => $v['uid'],
					'fans' => session('uid')
					);
				$info[$k]['followed'] = $db->where($where)->count();

			}
		}
		return $info;



	}
}