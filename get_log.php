<?php

function die_with_error($error) {
  $ret = array(
    "status" => "Failed",
    "error" => $error
  );
  die(json_encode($ret));
}

$date1 = $_GET["date1"];
$date2 = $_GET["date2"];

$hostname = '222.205.48.145';
$username = 'test';
$password = 'test';
$dbname = 'easypay';

mysql_connect($hostname, $username, $password) or die_with_error(mysql_error());
mysql_select_db($dbname) or die_with_error(mysql_error());
mysql_set_charset('utf8');


$query = sprintf("SELECT * FROM ordered WHERE payment_date >= '%s' and payment_date <= '%s';",
                 mysql_real_escape_string($date1), mysql_real_escape_string($date2));

$result = mysql_query($query);

if (! $result)
  die_with_error(mysql_error());

$result_array = array();
while($row = mysql_fetch_assoc($result)){

  array_push($result_array,
             array(
               "order_id" => $row['order_id'],
               "buyer_id" => $row['Buyer_id'],
               "seller_id" => $row['Seller_id'],
               "status" => $row['Status'],
               "total_amount" => $row['Payment_price'],
               "trade_time" => $row['payment_date']
             ));

}

$ret = array(
  "status" => "OK",
  "data" => $result_array
);
die(json_encode($ret));

?>