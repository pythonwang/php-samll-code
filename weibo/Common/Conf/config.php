<?php
return array(
	//'配置项'=>'配置值'
	//'MODULE_DENY_LIST'=>array('Common','Runtime','Admin'),
	//'MODULE_ALLOW_LIST'=>array('Home'),
	/*
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'localhost',
	'DB_USER'=>'root',
	'DB_PWD'=>'',
	'DB_NAME'=>'thinkphp',
	'DB_PORT'=>3306,
	*/
	
	
	'DB_TYPE'=>'pdo',
	'DB_USER'=>'root',
	'DB_PWD'=>'',
	'DB_PREFIX'=>'sw_',
	'DB_DSN'=>'mysql:host=localhost;dbname=mydb;charset=UTF8',




	'LANG_SWITCH_ON'     =>true,
	'LANG_AUTO_DETECT'   =>true,
	'LANG_LIST'          =>'zh-cn,zh-tw,en-us',
	'VAR_LANGUAGE'       =>'h1',







);