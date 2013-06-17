<?php

//防止恶意调用
if (!defined('IN_TG')) {
	exit('Access Defined!');
}
?>
	<div id="member_sidebar">
		<h2>中心导航</h2>
		<dl>
			<dt>用户查询</dt>
			<dd><a href="inquire.php">图书查询</a></dd>
			<dd><a href="adm_list.php">管理员信息</a></dd>
		</dl>
		<dl>
			<dt>图书入库</dt>
			<dd><a href="in_single.php">单本入库</a></dd>
			<dd><a href="in_batch.php">批量入库</a></dd>
		</dl>
		<dl>
			<dt>借还书服务</dt>
			<dd><a href="borrow.php">借书服务</a></dd>
			<dd><a href="return.php">还书服务</a></dd>
		</dl>
		<dl>
			<dt>管理员管理</dt>
			<dd><a href="card.php">借书证列表</a></dd>
			<dd><a href="ins_card.php">新增借书证</a></dd>
			<dd><a href="ins_adm.php">新增管理员</a></dd>
		</dl>


	</div>