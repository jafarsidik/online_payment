<?php
//定义个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','auditor');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//User Access Control 用户权限控制
_access();
?>


<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>对账审计</title>

    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">


    <style>
      body {
      padding-top: 60px;
      }
    </style>

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
                <li  class="active"><a href="./audit0.php">对账审计</a></li>
                <!-- <li><a href="./complain.html">处理投诉</a></li> -->
                <li><a href="./get_log0.php">提取日志</a></li>
                <li><a href="./inquery0.php">查询</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>

      <div class="container">

        <div class="hero-unit">
          <h1>对账审计</h1>
          <br/>
          <p>系统每日自动对账审计，同时点击按钮提供手动对账查询功能</p>
          <br/>
          <progress id="prog" value="0" max="100"></progress>
          <a class="btn btn-primary btn-large" id="audit" >
            对账
          </a>
          <div id="numValue">0%</div>
        </div>

        <div id="result">
          <table class="table" id="order_table">
          </table>
        </div>

      </div> <!-- /container -->
      <script type="text/javascript" src="js/jquery.js"></script>
      <script type="text/javascript" src="js/audit.js"></script>
      <script type="text/javascript">
        var currProgress = 0;
        var done = false;
        var total = 100;
        //  automatic auditing
        auditor_inspect();

        jQuery('#audit').click(function() {

            jQuery("#result").removeClass();
            jQuery("#order_table").empty();
            startProgress ();

            var timeout = window.setTimeout(function () {auditor_inspect();},
                                            2300);
        });

        function startProgress () {
            var prBar = document.getElementById("prog");
            var startButt = document.getElementById("audit");
            var val = document.getElementById("numValue");
            audit.disabled = true;
            prBar.value = currProgress;
            val.innerHTML = Math.round((currProgress/total)*100) + "%";
            currProgress++;

            if (currProgress>100) {done = true };
            if (!done) {
                setTimeout("startProgress()", 20);
            } else {
                document.getElementById("audit").disabled = false;
                done = false;
                currProgress = 0;
            }
        }

      </script>
    </body>
</html>
