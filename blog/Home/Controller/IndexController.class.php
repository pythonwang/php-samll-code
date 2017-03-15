<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$topcate = M('cate')->where(array('pid' =>0,))->order('sort')->select();
    	$cate = M('cate')->order('sort')->select();
    	$db = M('blog');
    	foreach ($topcate as $k => $v) {
    		$cids = getchildid($cate,$v['id']);
    		$cids[] = $v['id'];
    		$where = array('cid' => array('IN',$cids),'del' =>0);
    		//$topcate[$k]['blog'] = $db->field(array('id','title', 'time'))->where($where)->select();
    		//$uid = $db->where($where)->getField('uid');
    		$topcate[$k]['blog'] = D('UserView')->field(array('id','title','time','username'))->where($where)->select();
    	}
    	//S('index_list', $topcate,10);
    
    	$this->topcate = $topcate;
		$this->display();
    }

    //博客检索
    public function sechblog() {
    	if (isset($_GET['keyword'])) {
			$where['content'] = array('LIKE','%' . $_GET['keyword'] . '%');
			$where['title'] = array('LIKE','%' . $_GET['keyword'] . '%');
			$where['_logic'] = 'or';
			$total = M('blog')->where($where)->count();
	        $per = 10;
	        $page = new \Component\Page($total,$per);
	        $str = $page->limit;
	        $limit = substr($str,5);//把limit字符去掉
	        $blog = D('BlogView')->getAll($where,$limit);
	        $pagelist =$page->fpage();
	        
	        $this->blog = $blog;
	        $this->assign('page',$pagelist);
	        $this->count = $total;
			$this->weibo = $weibo ? $weibo : false;
				
			}

		$this->display();
    }
    
}