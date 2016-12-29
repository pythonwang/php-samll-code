<?php
return array(
	//'配置项'=>'配置值'

'DB_TYPE'   => 'mysql', // 数据库类型
'DB_HOST'   => 'localhost', // 服务器地址
'DB_NAME'   => 'weibo', // 数据库名
'DB_USER'   => 'root', // 用户名
'DB_PWD'    => '', // 密码
'DB_PREFIX' => 'hd_', // 数据库表前缀 
'DB_CHARSET'=> 'utf8', // 字符集
'ENCRYPTION_KEY' => 'www.timeblog.com',
'AUTO_LOGIN_TIME' => time() + 3600 * 24 * 7,
//路由配置
'MODULE_ALLOW_LIST' => array('Home','Admin'),
'DEFAULT_MODULE'=>'Home',
'URL_MODEL' => 1, //URL模式 
'URL_ROUTER_ON' => true,
'URL_ROUTE_RULES' => array(
	':id\d' => 'User/index',
	'follow/:uid\d' => array('User/followList', 'type=1'),
	'fans/:uid\d' => array('User/followList','type=0'),
	),

//自定义标签
'TAGLIB_LOAD' => true,
'APP_AUTOLOAD_PATH ' => '@.TagLib',
'TAGLIB_PRE_LOAD'	=> 'Home\TagLib\Hdtags',
'TAGLIB_BUILD_IN'    => 'Cx,Home\TagLib\Hdtags',

);