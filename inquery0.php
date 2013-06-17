<?php
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','inquery0');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//User Access Control 用户权限控制
_access();
?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>订单查询</title>
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
            <a class="brand" href="./index.html">A4</a>
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li><a href="./audit0.php">对账审计</a></li>
                <!-- <li><a href="./complain.html">处理投诉</a></li> -->
                <li><a href="./get_log0.php">提取日志</a></li>
                <li class="active"><a href="./inquery0.php">查询</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>

      <div class="container">

        <div class="hero-unit">
          <h1 id="inquery">查询</h1>
          <form>
            <fieldset>

              <div id="user">
                <legend>用户:</legend>
                <label>
                  用 户 名 <input type="text" name="buyer" placeholder="">
                </label>
              </div>

              <div id="money">
                <legend>选择待查询的交易金额(以元为单位):</legend>
                <label class="checkbox inline">
                  <input type="radio" name="bound" value="0"> 50以下
                </label><label class="checkbox inline">
                  <input type="radio" name="bound" value="1"> 50 - 100
                </label><label class="checkbox inline">
                  <input type="radio" name="bound" value="2"> 100 - 200
                </label><label class="checkbox inline">
                  <input type="radio" name="bound" value="3"> 200 - 500
                </label><label class="checkbox inline">
                  <input type="radio" name="bound" value="4"> 500 - 1000
                </label><label class="checkbox inline">
                  <input type="radio" name="bound" value="5"> 1000 - 10000
                </label>
                <label class="checkbox inline">
                  <input type="radio" name="bound" value="6"> 10000以上
                </label>
              </div>

              <div id="time">
                  <legend>按时间查询</legend>
                  <label>
                    开始日期 <input type="text" name="starttime" id="starttime">
                  </label>
                  <label>
                    终止日期 <input type="text" name="endtime" id="endtime">
                  </label>
              </div>
              <button type="button" class="btn btn-large btn-primary" id="query">提交</button>
            </fieldset>
          </form>

          <div id="result">
            <table class="table" id="order_table">

            </table>
          </div>

        </div>

      </div> <!-- /container -->

      <script type="text/javascript" src="js/inquery.js"></script>

    </body>
</html>
