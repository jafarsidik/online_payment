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

function _check_id($_string,$_max){
	if( mb_strlen($_string) > $_max){
		_alert_back("id不得多于'.$_max.'位！");
	}
	return _mysql_string($_string);
}

function _check_info($_string){
	if( mb_strlen($_string) > 50){
		_alert_back("单位信息不得多于50位！");
	}
	return _mysql_string($_string);
}

function _check_type($_string){
	if( mb_strlen($_string) > 10){
		_alert_back("借书者身份类型信息不得多于10位！");
	}
	return _mysql_string($_string);
}
function _check_length($_string,$_info,$_max){
	if( mb_strlen($_string) > $_max){
		_alert_back($_info);
	}
	return _mysql_string($_string);	
}

function _check_name($_string,$_min_num,$_max_num) {
	//去掉两边的空格
	$_string = trim($_string);
	if (mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num) {
		_alert_back('用户名长度不得小于'.$_min_num.'位或者大于'.$_max_num.'位');
	}
	return _mysql_string($_string);
}

function _check_password($_first_pass,$_end_pass,$_min_num) {
	//判断密码
	if (strlen($_first_pass) < $_min_num) {
		_alert_back('密码不得小于'.$_min_num.'位！');
	}
	
	//密码和密码确认必须一致
	if ($_first_pass != $_end_pass) {
		_alert_back('密码和确认密码不一致！');
	}
	
	//将密码返回
	return sha1($_first_pass);
}

function _check_contact($_string) {
	if ( mb_strlen($_string,'utf-8') > 200) {
		_alert_back('联系方式的内容不得大于200位！');
	}
	return $_string;
}

function _check_number($_string, $_max,$_info){
	if( $_string > $_max){
		_alert_back($_info);
	}
	return $_string;
}


?>