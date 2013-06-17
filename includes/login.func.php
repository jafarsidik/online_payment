<?php

//防止恶意调用
if (!defined('IN_TG')) {
	exit('Access Defined!');
}

if (!function_exists('_alert_back')) {
	exit('_alert_back()函数不存在，请检查!');
}

if (!function_exists('_mysql_string')) {
	exit('_mysql_string()函数不存在，请检查!');
}

/**
 * _setcookies生成登录cookies
 * @param unknown_type $_username
 * @param unknown_type $_uniqid
 */


function _setcookies($_id,$_name) {
			setcookie('name',$_name);
			setcookie('id',$_id);
}

function _check_password($_string,$_min_num) {
	//判断密码
	if (strlen($_string) < $_min_num) {
		_alert_back('密码不得小于'.$_min_num.'位！');
	}
	
	//将密码返回
	return sha1($_string);
}

?>