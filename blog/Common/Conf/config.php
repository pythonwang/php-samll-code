<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_USER' => 'root',
	'DB_PWD' => '',
	'DB_NAME' => 'blog',
	'DB_PREFIX' => 'tm_',
	'URL_HTML_SUFFIX' =>'',
	'MODULE_ALLOW_LIST' => array('Home','Admin'),
	'DEFAULT_MODULE'=>'Home',
	'URL_MODEL' => 1, //URL模式 
	'URL_ROUTER_ON' => true,
	'URL_ROUTE_RULES' => array(
	'show/:id\d' => 'Show/index',
	'more/:id\d' => array('List/index'),
	'fans/:uid\d' => array('User/followList','type=0'),
	),
);