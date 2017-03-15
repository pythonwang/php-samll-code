<?php
namespace Home\Model;
use Think\Model\ViewModel;
class BlogViewModel extends ViewModel {
	public $viewFields = array(
		'blog' =>array(
			'id','title','time','click','summary','content',
			'_type' =>'LEFT'
			),
		'user' =>array(
			'username' ,
			'_type' => 'LEFT',
			'_on' =>'blog.uid = user.id'
			),
		'cate' =>array(
			'name', '_on' => 'blog.cid = cate.id'

			),
		);

//分页
function getAll($where,$limit) {
	return $this->where($where)->limit($limit)->order('time DESC')->select();
}
}