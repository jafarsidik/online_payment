<?php
/**
*BMS--Books Management System
*================================================
*Author:Wang Yanlin
*Date:2012-2-15
*/
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','login');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//登录状态
_login_state();

//开始处理登录状态
if ($_GET['action'] == 'login') {
  //验证码
  _check_code($_POST['code'],$_SESSION['code']);
  //引入验证文件
  include ROOT_PATH.'includes/login.func.php';
  //接受数据
  $_clean = array();
  $_clean['id'] = $_POST['id'];
  $_clean['password'] = _check_password($_POST['password'],6);


  //到数据库去验证
  if (!!$_rows = _fetch_array("SELECT id,name FROM users WHERE id='{$_clean['id']}' AND password='{$_clean['password']}' LIMIT 1")) {
    _close();
    _session_destroy();
    _setcookies($_rows['id'],$_rows['name']);
    _location(null,'index.html');
  } else {
    _close();
    _session_destroy();
    _location('用户名或密码不正确！','login.php');
  }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>

  <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-timepicker-addon.css">
    <style>
      body {
      padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>


<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>

<body>

      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="./index.html">A4</a>
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li><a href="./audit0.php">对账审计</a></li>
                <!-- <li><a href="./complain.html">处理投诉</a></li> -->
                <li ><a href="./get_log0.php">提取日志</a></li>
                <li><a href="./inquery0.php">查询</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>

      <div class="container">
        <div id="login" class="hero-unit">

          <form class="form-horizontal" method="post" name="login" action="login.php?action=login">

            <div class="control-group">
              <label class="control-label" for="inputEmail"><h2>登录</h2></label>
            </div>

            <div class="control-group">
              <label class="control-label" for="inputEmail">用户名</label>
              <div class="controls">
                <input type="text" name="id" id="inputEmail" placeholder="用户名">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="inputPassword">密码</label>
              <div class="controls">
                <input type="password" name="password" id="inputPassword" placeholder="密码">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">验证码</label>
              <div class="controls">
                <input type="text"  name="code" placeholder="验证码">
                <img src="code.php" id="code" /> (点击图片刷新)
              </div>
            </div>

            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn btn-large btn-primary" id="query">登录</button>
              </div>
            </div>
          </form>
        </div>
      </div>

</body>
</html>