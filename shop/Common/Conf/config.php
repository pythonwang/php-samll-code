<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'shop', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	
	'DB_PREFIX' => 'group_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集

	'URL_HTML_SUFFIX' =>'',
	'AUTO_LOGIN_TIME' => time() + 3600 * 24 * 7,
	//商品配置项
	'goods_server' => array(
		1=>array(
			'name' =>'假一赔十',
			'img' =>'<span class="ico" style="background-position:0px -92px;"></span>'
			),
		2=>array(
			'name' =>'支持随时退款',
			'img' =>'<span class="ico" style="background-position:0px 0px;"></span>'
			),
		3=>array(
			'name' =>'不支持随时退款',
			'img' =>'<span class="ico" style="background-position:0px -121px;"></span>'
			),
		4=>array(
					'name'=>'7天无理由退换货',
					'img'=>'<span class="ico" style="background-position:0px -62px;"></span>'	
				),
		5=>array(
						'name'=>'不支持7天退换货',
						'img'=>'<span class="ico" style="background-position:0px -182px;"></span>'
				)
		),
	'price' => array(
		'all'=> array(
			array('100元以下','0-100'),
			array('100到200元','100-200'),
			array('200元到500元','200-500'),
			array('500元以上','500'),
			),
		'2'=> array(
			array('50元以下','0-50'),
			array('50到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),

			),
		'3'=> array(
			array('50元以下','0-50'),
			array('50到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),

			),
		'6'=> array(
			array('50元以下','0-50'),
			array('50到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),

			),
		'7'=> array(
			array('50元以下','0-50'),
			array('50到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),

			),
		'8'=> array(
			array('50元以下','0-50'),
			array('50到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),

			),
		'1'=> array(
			array('50元以下','0-50'),
			array('50到100元','50-100'),
			array('100元到200元','100-200'),
			array('200元以上','200'),

			)


		)
);