<?php

function die_with_error($error) {
  $ret = array(
      "status" => "Failed",
      "error" => $error
               );
  die(json_encode($ret));
}


/*
 * $lat0 = $_GET["lat0"];
 * $lng0 = $_GET["lng0"];
 * $lat1 = $_GET["lat1"];
 * $lng1 = $_GET["lng1"];
 */

/*
 * if (!$lat0 || !$lng0 || !$lat1 || !$lng1)
 *   die_with_error("invalid parameters");
 */

$hostname = 'localhost';
$username = 'jeremy';
$password = 'who dare see my password, wanna die?';
$dbname = 'SE';

mysql_connect($hostname, $username, $password) or die_with_error(mysql_error());
mysql_select_db($dbname) or die_with_error(mysql_error());
mysql_set_charset('utf8');

$query = "select final_price as price, money_amount as money, ordered.order_id from ordered,
payment where ordered.order_id = payment.order_id and payment.status = 'succeed';";

$result = mysql_query($query);

if (! $result)
  die_with_error(mysql_error());

$result_array = array();
while ($row = mysql_fetch_assoc($result)) {

  array_push($result_array,
             array(
                 "price" => $row['price'],
                 "money" => $row['money'],
                 "order_id" => $row['order_id']
                   ));
}


$ret = array(
    "status" => "OK",
    "data" => $result_array
             );
die(json_encode($ret));
?>