<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Home\Controller\CommonController;//继承公用的session['uid']
use Home\Model\WeiboViewModel;
use Home\Model\CommentViewModel;

class IndexController extends CommonController {
    public function index(){
       

        $db = D('WeiboView');
        $uid = array(session('uid'));
        
        $where = array('fans' => session('uid'));
        //显示分组成员微博
        if (isset($_GET['gid'])) {
            $gid = $_GET['gid'];
            $where['gid'] = $gid;
            $uid = array();
            # code...
        }
        
        $result = M('follow')->field('follow')->where($where)->select();
        if ($result) {
            foreach ($result as $v) {
                $uid[]=$v['follow'];
                # code...
            }
            # code...
        }

        $where = array('uid' => array('IN',$uid));

        //发布微博分页
        $total = $db->where($where)->count();
        $per = 10;
        $page = new \Component\Page($total,$per);
        $str = $page->limit;
        $limit = substr($str,5);//把limit字符去掉
        
        
        $result = $db->getAll($where,$limit);
        $pagelist =$page->fpage();
        $this->weibo = $result;
        $this->assign('page',$pagelist);
        $this->display();
	
    }
    //保存微博文字和图片
    public function sendWeibo() {
        if (!IS_POST) {
            E('页面不存在');
            # code...
        }
        $data = array(
            'content' => $_POST['content'],
            'time' =>time(),
            'uid' => session('uid'),
            );
       
    
        $wid = M('weibo')->add($data);

        if ($wid) {
            if (!empty($_POST['max'])) {
                $img = array(
                    'mini' => $_POST['mini'],
                    'medium' => $_POST['medium'],
                    'max' => $_POST['max'],
                    'wid' => $wid,
                    );
                M('picture')->add($img);
                # code...
            }
            M('userinfo')->where(array('uid' => session('uid')))->setInc('weibo');

            //处理@用户
             $this->_atmeHandel($data['content'], $wid);
            $this->success('发布成功',$_SERVER['HTTP_REFERER']);
            # code...
        }else{
            $this->error('发布失败，请重试...');
        }
    }

    //@用户处理
    public function _atmeHandel($content,$wid) {
        
        $preg = '/@(\S+?)\s/is';
       preg_match_all($preg, $content, $arr);
       //$str = explode('@',$content);
       //$arr = array_filter($str);
       
        
        if (!empty($arr[1])) {
            $db = M('userinfo');
            $atme = M('atme');
            foreach ($arr[1] as $v) {
                $uid = $db->where(array('username' => $v))->getField('uid');
                if ($uid) {
                    $data = array(
                        'wid' => $wid,
                        'uid' => $uid,
                        );
                    $atme->add($data);
                    # code...
                }
                
                # code...
            }
            # code...
        }
    }

    //转发微博
    public function turn() {
        if (!IS_POST) {
            E('页面不存在');
            # code...
        }

        $id = $_POST['id'];
        $tid = $_POST['tid'];
        $content = $_POST['content'];
        $data = array(
            'content' => $content,
            'isturn' => $tid ? $tid : $id,
            'time' => time(),
            'uid' => session('uid')
            );

        $db=M('weibo');
        $wid = $db->add($data);
        if ($wid) {
            $db->where(array('id' => $id))->setInc('turn');
            if ($tid) {
                $db->where(array('id' => $tid))->setInc('turn');
                # code...
            }
            M('userinfo')->where(array('uid' => session('uid')))->setInc('weibo');
            $this->_atmeHandel($data['content'], $wid);
//插入评论
            if (isset($_POST['becomment'])) {
                $data = array(
                    'content' => $content,
                    'time' => time(),
                    'uid' => session('uid'),
                    'wid' => $id,

                    );
                $comment = M('comment')->add($data);
                if ($comment) {
                    $db -> where(array('id' => $id))->setInc('comment');
                    # code...
                }
                # code...
            }

            $this->success('转发成功',$_SERVER['HTTP_REFERER']);
            # code...
        }else{
            $this->error('转发失败，请重试...');
        }
    }

    //收藏功能
    public function keep() {
        if (!IS_POST) {
            E('页面不存在');
            # code...
        }
        $wid = $_POST['wid'];
        $uid = session('uid');
        $db = M('keep');
        //检测用户是否已经收藏该微博
        $where = array('wid' => $wid, 'uid' => $uid);
        $keeped = $db->where($where)->getField('id');
        if ($keeped) {
            echo -1;
            exit();
            # code...
        }
        $data = array(
            'uid' => $uid,
            'time' => time(),
            'wid' => $wid
            );
        $z = $db->add($data);
        if ($z) {
            //收藏成功，收藏数加一
            M('weibo')->where(array('id' => $wid))->setInc('keep');
            echo 1;
            # code...
        }else{
            echo 0;
        }
    }

    public function comment() {
        if(!IS_POST) {
            E('页面不存在');
        }
        //提取评论数据
        $data = array(
            'content' => $_POST['content'],
            'time' => time(),
            'uid' => session('uid'),
            'wid' => $_POST['wid']
            );
        if (M('comment')->add($data)) {
            # code...
        
       //组合评论样式字符串返回
        $field = array('username','face50'=> 'face','uid');
        $where = array('uid' =>$data['uid']);
        $user = M('userinfo')->where($where)->field($field)->find();
        //被评论微博发布者用户名
        $uid = $_POST['uid'];
        $username = M('username')->where(array('uid' => $uid))->getField('username');
        $db =M('weibo');
        //评论加一
        $db->where(array('id' => $data['wid']))->setInc('comment');
        if ($_POST['isturn']) {
            //read weibo content
            $field = array('id','content','isturn');
            $weibo = $db->field($field)->find($data['wid']);
            $content = $weibo['isturn'] ? $data['content'] . ' // @'. $username . ' : ' . $weibo['content'] : $data['content'];
            $cons = array(
                'content' => $content,
                'isturn' => $weibo['isturn'] ? $weibo['isturn'] : $data['wid'],
                'time' => $data['time'],
                'uid' => $data['uid']


                );
            if($db->add($cons)) {
                $db->where(array('id' => $weibo['id']))->setInc('turn');
            }
            echo 1;
            exit;

            # code...
        }
            $str = '';
            $str .= '<dl class="comment_content">';
            $str .= '<dt><a href="' . U('/' . $data['uid']) . '">';
            $str .= '<img src="';
            $str .= __ROOT__;
            if ($user['face']) {
                $str .= '/Uploads/' . $user['face'];
                # code...
            }else{
                $str .= '/Public/Images/noface.gif';
            }
            $str .= '" alt="' . $user['username'] . '" width="30" height="30" />';//"为拼接src地址
           
            $str .= '</a></dt><dd>';  
            $str .= '<a href="' . U('/' . $data['uid']) . '" class="comment_name">';
            $str .= $user['username'] . '</a> : ' . replace_weibo($data['content']);
            $str .= '&nbsp;&nbsp;( ' . time_format($data['time']) . ' )';
            $str .= '<div class="reply">';
            $str .= '<a href="">回复</a>';
            $str .= '</div></dd></dl>';

            
            echo $str;

       }else{
        echo 'false';
       }
        }


        //异步获取评论内容
        public function getComment() {
            if (!IS_POST) {
                E('页面不存在');
                # code...
            }
            
            $wid = $_POST['wid'];
            $where = array('wid' => $wid);
            //评论分页
            $count = M('comment')->where($where)->count();
            $total = ceil($count/7);
            $page = isset($_POST['page']) ? $_POST['page'] : 1;
            $limit = $page < 2 ? '0,7' : (4*($page - 1)) . ',7';
            
            $db = D('CommentView');
            $result = $db->where($where)->order('time DESC')->limit($limit)->select();
            if($result) {
                $str = '';
                foreach ($result as $v) {
                     $str .= '<dl class="comment_content">';
            $str .= '<dt><a href="' . U('/' . $v['uid']) . '">';
            $str .= '<img src="';
            $str .= __ROOT__;
            if ($v['face']) {
                $str .= '/Uploads/' . $v['face'];
                # code...
            }else{
                $str .= '/Public/Images/noface.gif';
            }
            $str .= '" alt="' . $v['username'] . '" width="30" height="30" />';//"为拼接src地址
           
            $str .= '</a></dt><dd>';  
            $str .= '<a href="' . U('/' . $v['uid']) . '" class="comment_name">';
            $str .= $v['username'] . '</a> : ' . replace_weibo($v['content']);
            $str .= '&nbsp;&nbsp;( ' . time_format($v['time']) . ' )';
            $str .= '<div class="reply">';
            $str .= '<a href="">回复</a>';
            $str .= '</div></dd></dl>';
        }
        if ($total > 1) {
            $str .= '<dl class="comment-page">';
            switch ($page) {
                case $page > 1 && $page < $total :
                $str .= '<dd page="' . ($page - 1) . '" wid="' . $wid . '">上一页</dd>';
                $str .= '<dd page="' . ($page + 1) . '" wid="' . $wid . '">下一页</dd>';
                    break;
                case $page < $total :
                 $str .= '<dd page="' . ($page + 1) . '" wid="' . $wid . '">下一页</dd>';
                    break;
                    case $page == $total :
                    $str .= '<dd page="' . ($page - 1) . '" wid="' . $wid . '">上一页</dd>';
                    break;
            }
            $str .= '</dl>';
        }
        echo $str;

                    # code...
                }else{
                    echo 'false';
                }

            }
        
    //异步删除微博
    public function delWeibo() {
        if (!IS_POST) {
            E('页面不存在');
            # code...
        }
        $wid = $_POST['wid'];

        if (M('weibo')->delete($wid)) {
            $db = M('picture');
            $img = $db->where(array('wid' => $wid))->find();
            if ($img) {
                $db->delete($img['id']);//删除微博和文件图片
                @unlink('./Uploads/' . $img['mini']);
                @unlink('./Uploads/' . $img['medium']);
                @unlink('./Uploads/' . $img['max']);
                # code...
            }
            M('userinfo')->where(array('uid' => session('uid')))->setDec('weibo');
            M('comment')->where(array('wid' => $wid))->delete();
            echo 1;//传到js判断
            # code...
        }else{
            echo 0;
        }
    }

    
    public function loginOut() {
    	session_unset();
    	session_destroy();

    	@setcookie('auto','',time() - 3600,'/');

    	redirect(U('Login/index'));
    }
}