<?php
namespace Home\TagLib;
use Think\Template\TagLib;

class Hdtags extends TagLib {
	protected $tags = array(
		'userinfo' => array('attr' => 'id','close' =>1),
		'maybe' => array('attr' => 'uid', 'close' =>1)
		
		);
	//自定义用户信息标签，php代码引入模板<userinfo id="$_session[('id']
public function _userinfo($attr,$content) {
	$id = $attr['id'];
	$str = '';
	$str .= '<?php ';

	$str .= '$where = array("uid" => ' . $id . ');';
	$str .= '$field = array("username", "face80" => "face" ,"follow", "fans", "weibo","uid");';
	$str .= '$userinfo = M("userinfo")->where($where)->field($field)->find();';
	$str .= '?>';
	$str .= $content;
	return $str;

}

public function _maybe($attr,$content) {
	$uid = $attr['uid'];
	$str = '';
	$str .= '<?php ';
	$str .= '$uid = ' . $uid . ';';
	$str .= '$db = M("follow");';

	$str .= '$where = array("fans" => $uid);';
	$str .= '$follow = $db->where($where)->field("follow")->select();';
	$str .= 'foreach ($follow as $k => $v) :';
	$str .= ' $follow[$k] = $v["follow"];';
	$str .= 'endforeach;';
	$str .= '$sql = "select uid,username,face50 as face,count(f.follow) as count from hd_follow f left join hd_userinfo u on f.follow = u.uid where f.fans IN(" . implode(\',\',$follow) . ") and f.follow not in (" . implode(\',\',$follow) . ") and f.follow <> " . $uid . " group by f.follow order by count desc limit 4";';
	$str .= '$friend = $db->query($sql);';
	$str .= 'foreach ($friend as $v) :';
	$str .= 'extract($v);?>';
	$str .= $content;
	$str .= '<?php endforeach;?>';
	
	return $str;


}




	
}