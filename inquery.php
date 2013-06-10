<?php

error_reporting(E_ALL);

function die_with_error($error) {
  $ret = array(
      "status" => "Failed",
      "error" => $error
               );
  die(json_encode($ret));
}


if (!isset($_GET["bound"]) || !isset($_GET['buyer']) 
  || !isset($_GET['st']) || !isset($_GET['et']))
  die_with_error("invalid parameters");

$bound = $_GET["bound"];
$buyer = $_GET['buyer'];
$st = $_GET['st'];
$et = $_GET['et'];

switch ($bound) {
  case '0':
    $lower_bound = 0;
    $upper_bound = 50;
    break;

  case '1':
    $lower_bound = 50;
    $upper_bound = 100;
    break;

  case '2':
    $lower_bound = 100;
    $upper_bound = 200;
    break;

  case '3':
    $lower_bound = 200;
    $upper_bound = 500;
    break;

  case '4':
    $lower_bound = 500;
    $upper_bound = 1000;
    break;

  case '5':
    $lower_bound = 1000;
    $upper_bound = 10000;
    break;

  case '6':
    $lower_bound = 10000;
    break;

  default:
    break;
}

$hostname = 'localhost';
$username = 'jeremy';
$password = 'bbcc';
$dbname = 'SE';

mysql_connect($hostname, $username, $password) or die_with_error(mysql_error());
mysql_select_db($dbname) or die_with_error(mysql_error());
mysql_set_charset('utf8');

if ($upper_bound) {
  $query = "select * from ordered where buyer_id like '%" . $buyer ."%' and final_price >= " . $lower_bound . " and final_price <=" . $upper_bound;
} else {
    $query = "select * from ordered where buyer_id like '%" . $buyer ."%' and final_price >= " . $lower_bound;
}

if ($st) {
  $query = $query . " and order_date >= '" . $st . "'";
}
if ($et) {
  $query = $query . " and order_date <= '" . $et . "'"; 
}

$result = mysql_query($query. " ;");

if (! $result)
  die_with_error(mysql_error());

$result_array = array();
while ($row = mysql_fetch_assoc($result)) {

  array_push($result_array,
             array(

                 "order_id" => $row['order_id'],
                 "order_date" => $row['order_date'],
                 "order_type" => $row['order_type'],
                 "goods_id" => $row['goods_id'],
                 "status" => $row['status'],
                 "single_price" => $row['single_price'],
                 "final_price" => $row['final_price'],
                 "discount" => $row['discount'],
                 "amount" => $row['amount'],
                 'buyer_id' => $row['buyer_id'],
                 "address" => $row['address'],
                 "seller_id" => $row['seller_id']
                   ));
}


$ret = array(
    "status" => "OK",
    "data" => $result_array
             );
die(json_encode($ret));
?>