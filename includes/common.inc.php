<?php

//防止恶意调用
if (!defined('IN_TG')) {
	exit('Access Defined!');
}

//设置字符集编码
header('Content-Type: text/html; charset=utf-8');

//转换硬路径常量
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));

//创建一个自动转义状态的常量
define('GPC',get_magic_quotes_gpc());

//引入函数库
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'includes/mysql.func.php';

//数据库连接
define('DB_HOST','222.205.48.145');
define('DB_USER','test');
define('DB_PWD','test');
define('DB_NAME','easypay');

//初始化数据库
_connect();   //连接MYSQL数据库
_select_db();   //选择指定的数据库
_set_names();   //设置字符集


?>