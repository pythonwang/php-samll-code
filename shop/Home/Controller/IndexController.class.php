<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Home\Controller\CommonController;
class IndexController extends CommonController {
	public function index() {
		$this->setgoods();
        $this->setorderurl();
        $this->hotgoods();
		$this->setcate();
		$this->setlocal();
		$this->selcity();
		$this->setprice();
        $this->hotgroup();
		$this->display();	

	}
   
	//商品分类前台展示
    public function setcate(){
    	$db = M('category');
    	$cid = $_GET['cid'];
    	$lid = $_GET['lid'];
    	$this->setlocal();
    	//显示分类，顶级分类
    	if (empty($cid)) {
    		
    		$topcate = $db->field('cname,cid')->where(array('pid' =>0, 'display' =>1))->order('sort')->select();
    		$top = array();
    		$top[] = '<a  class ="active" href="">全部</a>';
    		foreach ($topcate as $v) {
    			if (empty($lid)) {
    				$top[] = '<a href="' . U('index') . '/cid/' . $v['cid'] . '">' . $v['cname']. '</a>';
    			}else{
    				$top[] = '<a href="' . U('index') . '/lid/' . $lid . '/cid/' . $v['cid'] . '">' . $v['cname']. '</a>';
    			}
    		}
    		
    		$this->topcate = $top;
    		
    	}else{
    		
    		//根据cid。高亮对应父类顶级菜单
    		$pid = $db->where(array('cid' => $cid))->getField('pid');
    		$topcate = $db->field('cname,cid')->where(array('pid' =>0, 'display' =>1))->order('sort')->select();
    		$top = array();
    		$top[] = '<a href="' . U('index') . '">全部</a>';
    		foreach ($topcate as $v) {
	    			if ($pid == $v['cid'] || $cid == $v['cid']) {
	    				/*选择子级，对于父级高亮，或者选中当前父级cid，当前标签高亮*/
		    				if (empty($lid)) {
		    					$top[] = '<a class="active" href="' . U('index') . '/cid/' . $v['cid'] . '">' . $v['cname']. '</a>';
		    				}else{
		    					$top[] = '<a class="active" href="' . U('index') . '/lid/' . $lid . '/cid/' . $v['cid'] . '">' . $v['cname']. '</a>';
		    				}
	    			}else{

	    						$top[] = '<a href="' . U('index') . '/lid/' . $lid . '/cid/' . $v['cid'] . '">' . $v['cname']. '</a>';
	    			}	
    		}
    		$this->topcate = $top;
    		//子分类
    		if ($pid == 0) {
    			$soncate = $db->where(array('pid' => $cid))->select();
    		}else{
    			$soncate = $db->where(array('pid' => $pid))->select();
    		}
    			//父级没有查询出子类，返回当前页
    			if (empty($soncate)) {
    				$ref = $_SERVER['HTTP_REFERER'];
					header("Location: $ref");
    				
    			}
    			$tmp = array();
    			if ($pid == 0) {
    				//选中顶级菜单，显示出所有子类，全部标签高亮
    				$tmp[] = '<a class ="active" href="' . U('index') . '">全部</a>';
    			}else{
    				//选座子类，子类全部标签不高亮
    				$tmp[] = '<a href="' . U('index') . '">全部</a>';
    			}
    			foreach ($soncate as $v) {
    				//高亮选中子类，传递当前子类cid
    				if ($v['cid'] == $cid) {
    					$tmp[] = '<a class ="active" href="">' . $v['cname'] . '</a>';
    				}else{
    					//正常显示未选中子类
    					if (empty($lid)) {
    						$tmp[] = '<a href="' . U('index') . '/cid/' . $v['cid'] . '">' . $v['cname']. '</a>';
    					}else{
    						$tmp[] = '<a href="' . U('index') . '/lid/' . $lid . '/cid/' . $v['cid'] . '">' . $v['cname']. '</a>';
    					}
    				}
    			}
    			
    			$this->soncate = $tmp;
    		
    	}
    	
    	
    	
			
    }
    //地区分类展示
    public function setlocal() {
    	$db = M('locality');
    	$lid = $_GET['lid'];
    	$cid = $_GET['cid'];
    	//显示分类，顶级分类
    	if (empty($lid)) {
    		
    		$toplocal = $db->field('lname,lid')->where(array('pid' =>1, 'display' =>1))->order('sort')->select();
    		$top = array();
    		$top[] = '<a  class ="active" href="' . U('index')  . '/lid/1' . '">全部</a>';
    		foreach ($toplocal as $v) {
    			if (empty($cid)) {
    				$top[] = '<a href="' . U('index')  . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
    			}else{
    				$top[] = '<a href="' . U('index') . '/cid/' . $cid . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
    			}
    		}
    		
    		$this->toplocal = $top;
    		
    	}else{
    		
	    		//根据lid。高亮对应父类顶级菜单
	    		$selfpid = $db->where(array('lid' => $lid))->getField('pid');
	    		if ($selfpid == 0) {
	    			$selfpid = $lid;
	    		}
	    		$pid = $db->where(array('lid' => $selfpid))->getField('pid');
	    		if ($pid == 0) {
	    		$toplocal = $db->field('lname,lid')->where(array('pid' =>$selfpid, 'display' =>1))->order('sort')->select();
	    		$top = array();
	    		$top[] = '<a href="' . U('index') . '">全部</a>';
		    		foreach ($toplocal as $v) {
			    			if ($selfpid == $v['lid'] || $lid == $v['lid']) {
			    				/*选择子级，对于父级高亮，或者选中当前父级cid，当前标签高亮*/
			    				if (empty($cid)) {
			    					$top[] = '<a class="active" href="' . U('index') . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
			    				}else{
			    					$top[] = '<a class="active" href="' . U('index') . '/cid/' . $cid . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
			    				}
			    			}else{
			    				if (empty($cid)) {
			    					$top[] = '<a href="' . U('index')  . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
			    				}else{
			    					$top[] = '<a href="' . U('index'). '/cid/' . $cid . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
			    				}
			    			}	
		    		}
    				$this->toplocal = $top;
	    		}else{
	    			
		    			//$plid = $db->where(array('lid' => $pid))->getField('pid');
		    			
		    			
			    		$toplocal = $db->field('lname,lid')->where(array('pid' =>$pid, 'display' =>1))->order('sort')->select();
			    		$top = array();
			    		$top[] = '<a href="' . U('index') . '">全部</a>';
			    		foreach ($toplocal as $v) {
				    			if ($selfpid == $v['lid'] || $lid == $v['lid']) {
				    				/*选择子级，对于父级高亮，或者选中当前父级cid，当前标签高亮*/
					    				if (empty($cid)) {
					    					$top[] = '<a class="active" href="' . U('index') . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
					    				}else{
					    					$top[] = '<a class="active" href="' . U('index') . '/cid/' . $cid . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
					    				}
				    			}else{
				    					if (empty($cid)) {
				    					$top[] = '<a href="' . U('index'). '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
				    					}else{
				    						$top[] = '<a href="' . U('index'). '/cid/' . $cid . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
				    					}
				    			}	
	    				}
	    			$this->toplocal = $top;

	    		}
		    		//子分类
		    		$firstpid = M('locality')->where(array('lid' => $lid))->getField('pid');
		    		
		    		if ($firstpid != 0) {
				    		$toppid = M('locality')->where(array('lid' => $firstpid))->getField('pid');
				    		if ($toppid == 0) {
				    				$sonlocal = $db->where(array('pid' => $lid))->select();
				    			
				    		}else{
				    				$sonlocal = $db->where(array('pid' => $firstpid))->select();
				    		}
				    }
		    		
		    		//父级没有查询出子类，返回当前页
		    		if (empty($sonlocal)) {
			    			//$ref = $_SERVER['HTTP_REFERER'];
							//header("Location: $ref");
		    			$sonlocal = null;
		    			return $sonlocal;
		    				
		    		}

		    		$tmp = array();
		    		if ($firstpid != 0) {
		    				//选中顶级菜单，显示出所有子类，全部标签高亮
		    				$tmp[] = '<a class ="active" href="' . U('index') . '">全部</a>';
		    		}else{
		    				//选座子类，子类,全部标签不高亮
		    				$tmp[] = '<a href="' . U('index') . '">全部</a>';
		    		}
		    		foreach ($sonlocal as $v) {
		    				//高亮选中子类，传递当前子类cid
		    				if ($v['lid'] == $lid) {
		    					if (empty($cid)) {
		    						$tmp[] = '<a class ="active" href="' . U('index') . '/lid/' . $v['lid'] . '">' . $v['lname'] . '</a>';
		    					}else{
		    						$tmp[] = '<a class ="active" href="' . U('index') . '/cid/' . $cid . '/lid/' . $v['lid'] . '">' . $v['lname'] . '</a>';
		    					}
		    				}else{
		    					//正常显示未选中子类
		    					if (empty($cid)) {
		    						$tmp[] = '<a href="' . U('index') . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
		    					}else{
		    						$tmp[] = '<a href="' . U('index') . '/cid/' . $cid . '/lid/' . $v['lid'] . '">' . $v['lname']. '</a>';
		    					}
		    				}
		    		}
		    			
	    			$this->sonlocal = $tmp;
	    		
    	}
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

    //价格显示
    public function setprice() {
    	$db = M('category');
    	$cid = $_GET['cid'];
    	$lid = $_GET['lid'];
    	$getprice = $_GET['getprice'];
    	$key = '';
    	if (empty($cid)) {
    		$key = 'all';
    	}else{
    		$pid = $db->where(array('cid' => $cid))->getField('pid');
    		$key = $pid ? $pid : $cid;
    	}
    	$prices = C('price');
    	$price = $prices[$key];
    	$tmp = array();
    	if (empty($price)) {
    		$tmp[] = '<a class="active" href="' . U('index') . '">全部</a>';
    	}else{
    		$tmp[] = '<a href="' . U('index') . '">全部</a>';
    	}
    	
    	foreach ($price as $v) {
    			
    		   if ( $getprice==$v[1]) {
    		   		if (empty($lid)) {
                        if (empty($cid)) {
                            $tmp[] = '<a class="active" href="' . U('index') . '/getprice/' . $v[1] . '">' . $v[0] . '</a>';
                        }else{
	    				    $tmp[] = '<a class="active" href="' . U('index') . '/getprice/' . $v[1] . '/cid/' . $cid . '">' . $v[0] . '</a>';
                        }
	    			}else{
                        if (empty($cid)) {
                            $tmp[] = '<a class="active" href="' . U('index') . '/getprice/' . $v[1] . '/lid/' . $lid . '">' . $v[0] . '</a>';
                        }else{
	    				    $tmp[] = '<a class="active" href="' . U('index') . '/getprice/' . $v[1] . '/lid/' . $lid . '/cid/' . $cid . '">' . $v[0] . '</a>';
                        }
	    			}
	    		}else{
	    				if (empty($lid)) {
                            if (empty($cid)) {
	    					    $tmp[] = '<a  href="' . U('index') . '/getprice/' . $v[1] . '">' . $v[0] . '</a>';
                            }else{
                                $tmp[] = '<a  href="' . U('index') . '/getprice/' . $v[1] . '/cid/' . $cid . '">' . $v[0] . '</a>';
                            }
	    				}else{
                            if (empty($cid)) {
	    					    $tmp[] = '<a  href="' . U('index') . '/getprice/' . $v[1] . '/lid/' . $lid . '">' . $v[0] . '</a>';
                            }else{
                                $tmp[] = '<a  href="' . U('index') . '/getprice/' . $v[1] . '/lid/' . $lid . '/cid/' . $cid . '">' . $v[0] . '</a>';
                            }
	    				}
	    		}
	    }
	    	$this->price = $tmp;
	   
    	}
        //商品显示查询条件
    public function setgoods() {
    	$cid = $_GET['cid'];
    	$lid = $_GET['lid'];
    	$price = $_GET['getprice'];
        $order = $_GET['order'];
        $per = 7;
        $fields = array('gcid', 'glid', 'gid', 'price', 'goods_max_img', 'goods_med_img', 'goods_small_img', 'goods_mini_img','main_title', 'sub_title', 'old_price','buy');

        //设置搜索条件
        if (!empty($_GET['keywords'])) {
            $keywords = $_GET['keywords'];
            $where['main_title'] = array('like',"%{$keywords}%");
            $where['sub_title'] = array('like',"%{$keywords}%");
            $where['_logic'] = 'or';
            $goods = M('goods')->field(array('gid', 'price', 'goods_max_img', 'goods_med_img', 'goods_small_img', 'goods_mini_img','main_title', 'sub_title', 'old_price','buy'))->where($where)->select();
            $this->goods = $goods;
            return;
        }
    	//商品子分类查询条件
    	if (!empty($cid)) {
    		$cids = D('GoodsView')->where(array('pid' => $cid))->getField('cid',true);
    		if (empty($cids)) {
    			$cids = $cid;
    		
    		}
    		
    		//foreach ($soncids as $v) {
    		//	$cids['gcid'][] = $v['cid'];
    		//}
    		
    	}
    	//设置价格筛选
    	if (!empty($price)) {
    		$arr = explode('-',$price);
    		if (isset($arr[1])) {
    			$seprice = 'goods.price > '. $arr[0];
    			$seprice2 = 'goods.price <' . $arr[1];
    		}else{
    			$seprice = 'goods.price >' . $arr[0];
    			$seprice2 = 'goods.price >' . $arr[0];
    		}
    		
    	}else{
    		$seprice = 'goods.price > 0'; 
    		$seprice2 = 'goods.price > 0';
    	}
    	//地区子分类查询条件
    	if (!empty($lid)) {
    		$localpid = M('locality')->where(array('lid' => $lid))->getField('pid');
    		if ($localpid == 0) {
    			$sonlocallid = M('locality')->where(array('pid' => $lid))->getField('lid',true);
    			$sonlids = M('locality')->where(array('pid' =>array('IN',$sonlocallid)))->getField('lid',true);
    			$lids = D('GoodsView')->where(array('pid' =>array('IN',$sonlocallid)))->getField('lid',true);
    		}else{
    			$sonlids = M('locality')->where(array('pid' => $lid))->getField('lid',true);
    			$lids = D('GoodsView')->where(array('pid' =>array('IN',$lid)))->getField('lid',true);
    		}
    		
    		if (empty($lids)) {
    			$lids = $lid;
    		}
    		//foreach ($sonlids as $v) {
    		//	$lids['glid'][] = $v['lid'];
    		//}
    		//dump($sonlids);
            
	    	
	    		$goods = null;
	    	if (!empty($cids) && !empty($lids)) {
		    	
		    	$total = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids),'glid' =>array('IN', $lids), $seprice,$seprice2))->count();
                $page = new \Component\Page($total,$per);
                $str = $page->limit;
                $limit = substr($str,5);//把limit字符去掉
                //价格，销量排序筛选
                if(!empty($order)){
                $ord = explode('-',$order);
                switch($ord[0]) {
                    case 't':
                        //上架时间降序
                        $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids),'glid' =>array('IN', $lids), $seprice,$seprice2))->order('begin_time desc')->limit($limit)->select();
                        break;
                    case 'b':
                        $order = 'buy ' . $arr[1];
                        //buy销量降序
                        $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids),'glid' =>array('IN', $lids), $seprice,$seprice2))->order('buy desc')->limit($limit)->select();
                        break;
                    case 'pd':
                        $order = 'price';
                        //price价格降序
                        $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids),'glid' =>array('IN', $lids), $seprice,$seprice2))->order('price desc')->limit($limit)->select();
                        break;
                    case 'pa':
                        $order = 'price';
                        //price价格升序
                        $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids),'glid' =>array('IN', $lids), $seprice,$seprice2))->order('price asc')->limit($limit)->select();
                        break;
                    
                    }
                
                    }else{
                        $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids),'glid' =>array('IN', $lids), $seprice,$seprice2))->order('buy desc')->limit($limit)->select();
                    }
                
                //echo D('GoodsView')->getlastsql();
				

			}else{
				if (!empty($cids)) {
					
					$total = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids), $seprice,$seprice2))->count();
                    $page = new \Component\Page($total,$per);
                    $str = $page->limit;
                    $limit = substr($str,5);//把limit字符去掉
                     if(!empty($order)){
                        $ord = explode('-',$order);
                        switch($ord[0]) {
                            case 't':
                                //上架时间降序
                                $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids), $seprice,$seprice2))->order('begin_time desc')->limit($limit)->select();
                                break;
                            case 'b':
                                
                                //buy销量降序
                                $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids), $seprice,$seprice2))->order('buy desc')->limit($limit)->select();
                                break;
                            case 'pd':
                                
                                //price价格降序
                                $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids), $seprice,$seprice2))->order('price desc')->limit($limit)->select();
                                break;
                            case 'pa':
                                
                                //price价格升序
                                $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids), $seprice,$seprice2))->order('price asc')->limit($limit)->select();
                                break;
                            
                            }
                        
                            }else{
                                $goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids), $seprice,$seprice2))->order('buy desc')->limit($limit)->select();
                            }
					       //$goods = D('GoodsView')->field($fields)->where(array('gcid' => array('IN', $cids), $seprice,$seprice2))->order($order)->limit($limit)->select();
                            //echo D('GoodsView')->getlastsql();
				}
				if (!empty($lids)) {
					
					$total = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids),$seprice,$seprice2))->count();
                    $page = new \Component\Page($total,$per);
                    $str = $page->limit;
                    $limit = substr($str,5);//把limit字符去掉
                    if(!empty($order)){
                        $ord = explode('-',$order);
                        switch($ord[0]) {
                            case 't':
                                //上架时间降序
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('begin_time desc')->limit($limit)->select();
                                break;
                            case 'b':
                                //buy销量降序
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('buy desc')->limit($limit)->select();
                                break;
                            case 'pd':
                                
                                //price价格降序
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('price desc')->limit($limit)->select();
                                break;
                            case 'pa':
                                
                                //price价格升序
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('price asc')->limit($limit)->select();
                                break;
                            
                            }
                        
                            }else{
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('buy desc')->limit($limit)->select();
                            }
                               // $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids),$seprice,$seprice2))->order($order)->limit($limit)->select();
                            //echo D('GoodsView')->getlastsql();
					
				}

			}
		}else{
			$sonlid = M('locality')->where(array('pid' => 1))->getField('lid',true);
			$lids = D('GoodsView')->where(array('pid' =>array('IN',$sonlid)))->getField('lid',true);
            $total = D('GoodsView')->field($fields)->where(array('glid' =>array('IN', $lids), $seprice,$seprice2))->count();
            $page = new \Component\Page($total,$per);
            $str = $page->limit;
			$limit = substr($str,5);//把limit字符去掉
            if(!empty($order)){
                        $ord = explode('-',$order);
                        switch($ord[0]) {
                            case 't':
                                //上架时间降序
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('begin_time desc')->limit($limit)->select();
                                break;
                            case 'b':
                                
                                //buy销量降序
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('buy desc')->limit($limit)->select();
                                break;
                            case 'pd':
                                
                                //price价格降序
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('price desc')->limit($limit)->select();
                                break;
                            case 'pa':
                                
                                //price价格升序
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('price asc')->limit($limit)->select();
                                break;
                            
                            }
                        
                            }else{
                                $goods = D('GoodsView')->field($fields)->where(array('glid' => array('IN', $lids), $seprice,$seprice2))->order('buy desc')->limit($limit)->select();
                            }
                                //$goods = D('GoodsView')->field($fields)->where(array('glid' =>array('IN', $lids), $seprice,$seprice2))->order($order)->limit($limit)->select();
                            //echo D('GoodsView')->getlastsql();
		}
        //分页
            $pagelist =$page->fpage();
            $this->assign('page',$pagelist);
		    $this->goods = $goods;	
	}
    //销量，价格等条件排序
    public function setorderurl() {

            
        $url = $_SERVER['REQUEST_URI'];
        if(!empty($_GET['order'])) {
            $url = strstr($url,'/order',true);
        }
        $orderurl['d'] = $url . '/order/t-desc';
        //buy销量降序
        $orderurl['b'] = $url . '/order/b-desc';
        //price价格降序
        $orderurl['pd'] = $url . '/order/pd-desc';
        //price价格升序
        $orderurl['pa'] = $url . '/order/pa-asc';
        //begin_time上架时间降序
        $orderurl['t'] = $url . '/order/t-desc';
        $this->orderurl = $orderurl;
    }
    //热卖商品
    private function hotgoods() {
        $fields = array(
            'main_title',
            'gid',
            'goods_mini_img',
            'price',
            'buy'
            );
        $hotgoods = M('goods')->field($fields)->order('buy DESC')->limit(5)->select();
        $this->hotgoods = $hotgoods;
    }
    //热门团购
    private function hotgroup() {
        $fields = array('cid','cname');
        $hotgroup = D('HotView')->field($fields)->group('cid')->order('buy DESC')->limit(8)->select();
        $this->hotgroup = $hotgroup;
    }
    
   
}