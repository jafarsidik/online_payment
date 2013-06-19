<?php
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','log_get');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//User Access Control 用户权限控制
_access();
?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>提取日志</title>
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-timepicker-addon.css">
    <style>
      body {
      padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      #inquery {
      margin-bottom: 20px;
      }
      #user, #money, #time {
      margin-bottom: 20px;
      color: #888;
      }
      input[type=radio]{
      width:10px;
      height:15px;
      margin-bottom: 5px;
      }

    </style>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>

    <body>

      <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="./index.html">易付通</a>
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li><a href="./audit0.php">对账审计</a></li>
                <!-- <li><a href="./complain.html">处理投诉</a></li> -->
                <li class="active"><a href="./get_log0.php">提取日志</a></li>
                <li><a href="./inquery0.php">查询</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>

      <div class="container">

        <div class="hero-unit">
          <h1 id="inquery">提取日志</h1>
          <form>
            <fieldset>

              <div id="time">
                <legend>选择想提取日志的日期间隔</legend>
                <label>
                  开始日期 <input type="text" name="starttime" id="starttime">
                </label>
                <label>
                  终止日期 <input type="text" name="endtime" id="endtime">
                </label>
              </div>
              <button type="button" class="btn btn-large btn-primary"
              id="log">提交</button>
              <button class="btn btn-large btn-primary" type="button"
              id="export">导出</button>

            </fieldset>
          </form>

          <div id="result">
            <table class="table" id="log_table">

            </table>
          </div>

        </div>

      </div> <!-- /container -->
      <script type="text/javascript" src="js/jquery.generateFile.js"></script>
      <script type="text/javascript" src="js/log.js"></script>
    </body>
</html>
