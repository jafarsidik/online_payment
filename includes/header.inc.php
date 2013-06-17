<?php

//防止恶意调用
if (!defined('IN_TG')) {
	exit('Access Defined!');
}
?>
<div id="header">
	<h1><a href="index.php">图书管理系统</a></h1>
	<ul>
		<li><a href="index.php">首页</a></li>
		<?php 
			if (isset($_COOKIE['name'])){
				echo '<li><a href="inquire.php">'.$_COOKIE['name'].'·管理中心</a> '.$GLOBALS['message'].'</li>';
				echo "\n";
				echo '<li><a href="logout.php">退出</a></li>';
			} else {	
				echo '<li><a href="login.php">登录</a></li>';
				echo "\n";
			}
		?>
	</ul>
</div>