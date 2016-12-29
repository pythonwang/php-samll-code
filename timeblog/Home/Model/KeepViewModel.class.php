<?php
namespace Home\Model;
use Think\Model;
use Think\Model\ViewModel;
class KeepViewModel extends ViewModel{
	public $viewFields = array(
		'keep' => array(
			'id' => 'kid', 'time' => 'ktime',
			'_type' => 'INNER'
			),
		'weibo' => array(
			'id', 'content', 'isturn', 'time', 'turn', 'comment', 'uid',
			'_on' => 'keep.wid = weibo.id',
			'_type' => 'LEFT'
			),
		'picture' => array(
			'mini', 'medium', 'max',
			'_on' => 'weibo.id = picture.wid',
			'_type' => 'LEFT'

			),
		'userinfo' => array(
			'username', 'face50' =>'face', 
			'_on' =>'weibo.uid = userinfo.uid'
			)
		);
	public function getAll($where,$limit) {
		$result = $this->where($where)->order('ktime DESC')->limit($limit)->select();
		$db = D('WeiboView');
		foreach ($result as $k => $v) {
			if ($v['isturn']) {
				$result[$k]['isturn'] = $db->find($v['isturn']);
				# code...
			}
			# code...
		}
		return $result;
	}
	}